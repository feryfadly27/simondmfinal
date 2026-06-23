<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatatanKesehatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DataPasienController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $users = User::where('role', 0)
            ->when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', "%$query%");
            })
            ->get()
            ->map(function ($user) {
                $user->umur = Carbon::parse($user->tanggal_lahir)->age;
                $user->catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)->latest()->first();
                return $user;
            });

        $petugas = Auth::user();

        return view('admin.data-pasien', compact('users', 'petugas'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
    
        // Catatan terbaru
        $catatanKesehatan = CatatanKesehatan::where('user_id', $id)
            ->latest()
            ->first();
    
        // Semua riwayat catatan kesehatan
        $riwayatCatatan = CatatanKesehatan::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('admin.detail', compact('user', 'catatanKesehatan', 'riwayatCatatan'));
    }


    // Di controller admin
    public function riwayat($userId)
    {
        $user = User::findOrFail($userId);
    
        $catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('admin.riwayat-kesehatan', compact('user', 'catatanKesehatan'));
    }

}
