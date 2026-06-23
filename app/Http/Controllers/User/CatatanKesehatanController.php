<?php
namespace App\Http\Controllers\User;

use App\Models\RiwayatGula;
use Illuminate\Http\Request;
use App\Models\CatatanKesehatan;
use App\Http\Controllers\Controller;

class CatatanKesehatanController extends Controller
{
    public function kesehatan()
    {
        $user = auth()->user();
    
        // Ambil catatan kesehatan terbaru
        $catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
    
        // Default: Bisa menambahkan data
        $canAddNewData = true;
    
        if ($catatanKesehatan) {
            $lastCreatedDate = $catatanKesehatan->created_at->toDateString(); // Ambil tanggal tanpa jam
            $todayDate = now()->toDateString(); // Tanggal hari ini tanpa jam
        
            // Cek apakah sudah hari yang berbeda (reset di jam 00:00)
            $canAddNewData = $lastCreatedDate !== $todayDate;
        }
    
        return view('user.catatan-kesehatan', compact('user', 'catatanKesehatan', 'canAddNewData'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'umur' => 'required|integer',
            'kategori' => 'required|string',
            'gula' => 'required|numeric',
            'sistolik' => 'required|integer',
            'Diastolik' => 'required|integer',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
        ]);
    
        // Simpan data baru tanpa menghapus yang lama
        CatatanKesehatan::create([
            'user_id' => auth()->user()->id,
            'umur' => $request->umur,
            'kategori' => $request->kategori,
            'gula' => $request->gula,
            'sistolik' => $request->sistolik,
            'diastolik' => $request->Diastolik,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);
    
        RiwayatGula::create([
            'user_id' => auth()->user()->id,
            'gula' => $request->gula,
        ]);
    
        return redirect()->route('kesehatan')->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $catatanKesehatan = CatatanKesehatan::where('id', $id)
                            ->where('user_id', auth()->user()->id)
                            ->first();

        if ($catatanKesehatan) {
            // Hapus catatan kesehatan
            $catatanKesehatan->delete();

            // Hapus riwayat gula terkait jika ada
            RiwayatGula::where('user_id', auth()->user()->id)->delete();

            return redirect()->route('riwayat')->with('success', 'Catatan kesehatan dan riwayat gula berhasil dihapus.');
        }

        return redirect()->route('riwayat')->with('error', 'Catatan kesehatan tidak ditemukan atau tidak dapat dihapus.');
    }


    public function riwayat()
    {
        $user = auth()->user();
    
        // Ambil semua catatan kesehatan milik user, urutkan dari terbaru ke terlama
        $catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get(); // Gunakan get() agar semua data diambil
    
        return view('user.riwayat-kesehatan', compact('user', 'catatanKesehatan'));
    }
}
