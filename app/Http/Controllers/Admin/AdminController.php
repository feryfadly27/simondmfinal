<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatatanKesehatan;
use App\Models\RiwayatGula;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $petugas = Auth::user();


        return view('admin.admin', compact('petugas'));
    }

    public function profile()
    {
        $user = Auth::user();
        $umur = Carbon::parse($user->tanggal_lahir)->age;
        $catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)->latest()->first();
        $gulaDarah = $catatanKesehatan ? $catatanKesehatan->gula : null;

        $statusDiabetes = match (true) {
            $gulaDarah === null => 'Data Gula Tidak Tersedia',
            $gulaDarah < 140 => 'Non Diabetes',
            $gulaDarah < 200 => 'Waspada',
            default => 'Diabetes',
        };

        return view('admin.profile', compact('user', 'umur', 'statusDiabetes'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $user = Auth::user();
        $user->name = $validated['name'];

        if ($request->hasFile('foto')) {
            if ($user->foto && \Storage::exists('public/' . $user->foto)) {
                \Storage::delete('public/' . $user->foto);
            }

            $path = $request->file('foto')->store('foto', 'public');
            $user->foto = $path;
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
    }

    public function listUsers(Request $request)
    {
        $search = $request->input('search');

        $users = User::select('id', 'name', 'email', 'role', 'tanggal_lahir')
                    ->when($search, function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    })
                    ->where('role', '!=', 1) // Sembunyikan admin
                    ->orderBy('created_at', 'asc')
                    ->get();

        return view('admin.users', compact('users'));
    }
    
    
    public function updateUserRole($id, Request $request)
    {
        $user = User::findOrFail($id);

        if ($request->role == 0) {
            $user->role = 0; // Set role ke user (terverifikasi)
            $user->save();
            return response()->json(['success' => true, 'message' => 'User berhasil diverifikasi.']);
        }

        return response()->json(['success' => false, 'message' => 'Aksi tidak valid.']);
    }
}