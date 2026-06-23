<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengingatUser;
use Illuminate\Support\Facades\Auth;

class PengingatKontrolController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pengingat = PengingatUser::where('user_id', $userId)->get();

        // view diubah jadi 'user.pengingat-kontrol'
        return view('user.pengingat-kontrol', compact('pengingat'));
    }

    public function tandaiDibaca($id)
    {
        $pengingat = PengingatUser::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        $pengingat->update(['dibaca' => 1]);

        return redirect()->route('pengingat-kontrol.index')->with('success', 'Pengingat ditandai sebagai sudah dibaca.');
    }
}

