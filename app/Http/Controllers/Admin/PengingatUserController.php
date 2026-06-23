<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengingatUser;
use App\Models\User;
use Illuminate\Http\Request;

class PengingatUserController extends Controller
{
    // Menampilkan daftar pengingat
    public function index(Request $request)
    {
        $query = $request->input('search');
    
        $pengingatUsers = PengingatUser::when($query, function ($q) use ($query) {
                $q->where('judul', 'like', "%$query%")
                  ->orWhere('pesan', 'like', "%$query%");
            })
            ->orderBy('created_at', 'asc')
            ->get();
        
        $users = User::all(); // Untuk select di modal edit
        return view('admin.pengingat-user', compact('pengingatUsers', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'tanggal' => 'required|date',
            'user_id' => 'required',
        ]);

        // Cek apakah created_at dan updated_at nya sama
        $now = now();
        $isAllUsers = false;

        if ($request->user_id === 'all') {
            $users = User::where('role', '!=', 1)->get(); // hanya user non-admin
            foreach ($users as $user) {
                PengingatUser::create([
                    'judul' => $request->judul,
                    'pesan' => $request->pesan,
                    'tanggal' => $request->tanggal,
                    'user_id' => $user->id,
                ]);
            }
            return redirect()->route('admin.pengingat-user')->with('success', 'Pengingat berhasil dikirim ke semua pengguna!');
        } else {
            // Validasi tambahan untuk memastikan user_id ada di tabel users
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);

            // Periksa apakah tanggal created_at dan updated_at sama
            $user = User::find($request->user_id);

            // Jika created_at dan updated_at sama, set keterangan "All User"
            if ($user && $user->created_at == $user->updated_at) {
                $isAllUsers = true;
            }

            // Jika keterangan All User, set ke 'all' user
            PengingatUser::create([
                'judul' => $request->judul,
                'pesan' => $request->pesan,
                'tanggal' => $request->tanggal,
                'user_id' => $isAllUsers ? 'all' : $request->user_id,
            ]);

            return redirect()->route('admin.pengingat-user')->with('success', 'Pengingat berhasil dikirim!');
        }
    }


    // Menghapus pengingat
    public function destroy($id)
    {
        $pengingat = PengingatUser::findOrFail($id);
        $pengingat->delete();

        return redirect()->route('admin.pengingat-user')->with('success', 'Pengingat berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'tanggal' => 'required|date',
            'user_id' => 'required',
        ]);
    
        // Periksa apakah pengingat ditujukan untuk semua pengguna
        if ($request->user_id === 'all') {
            // Hapus pengingat yang ada dengan ID tersebut
            PengingatUser::where('id', $id)->delete();
        
            // Ambil semua pengguna non-admin
            $users = User::where('role', '!=', 1)->get();
        
            // Buat pengingat baru untuk setiap pengguna
            foreach ($users as $user) {
                PengingatUser::create([
                    'judul' => $request->judul,
                    'pesan' => $request->pesan,
                    'tanggal' => $request->tanggal,
                    'user_id' => $user->id,
                ]);
            }
        
            return redirect()->route('admin.pengingat-user')->with('success', 'Pengingat berhasil dikirim ke semua pengguna!');
        } else {
            // Validasi tambahan untuk memastikan user_id ada di tabel users
            $request->validate([
                'user_id' => 'exists:users,id',
            ]);
        
            // Temukan pengingat yang akan diperbarui
            $pengingat = PengingatUser::findOrFail($id);
        
            // Cek apakah created_at dan updated_at sama
            $user = User::find($request->user_id);
            $isAllUsers = false;
        
            // Jika created_at dan updated_at sama, set keterangan "All User"
            if ($user && $user->created_at == $user->updated_at) {
                $isAllUsers = true;
            }
        
            // Jika keterangan All User, set ke 'all' user
            $pengingat->update([
                'judul' => $request->judul,
                'pesan' => $request->pesan,
                'tanggal' => $request->tanggal,
                'user_id' => $isAllUsers ? 'all' : $request->user_id,
            ]);
        
            return redirect()->route('admin.pengingat-user')->with('success', 'Pengingat berhasil diperbarui!');
        }
    }
    

}
