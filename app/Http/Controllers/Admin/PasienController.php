<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Method untuk menampilkan halaman pasien
    public function index()
    {
        return view('admin.pasien'); // Mengarahkan ke view pasien.blade.php
    }
}
