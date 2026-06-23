<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CatatanKesehatan;
use App\Models\RiwayatGula;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Pastikan untuk mengimpor model User

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $riwayatGula = RiwayatGula::where('user_id', $user->id)->get();
        $catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)->latest()->first();
        $gulaDarah = $catatanKesehatan ? $catatanKesehatan->gula : null;

        if ($gulaDarah === null) {
            $statusDiabetes = 'Data Gula Tidak Tersedia';
        } elseif ($gulaDarah < 140) {
            $statusDiabetes = 'Non Diabetes';
        } elseif ($gulaDarah < 200) {
            $statusDiabetes = 'Waspada';
        } else {
            $statusDiabetes = 'Diabetes';
        }

        return view('user.dashboard', compact('riwayatGula', 'user', 'statusDiabetes', 'catatanKesehatan'));
    }

    public function profile()
    {
        $user = Auth::user();
        $umur = Carbon::parse($user->tanggal_lahir)->age;
        $catatanKesehatan = CatatanKesehatan::where('user_id', $user->id)->latest()->first();
        $gulaDarah = $catatanKesehatan ? $catatanKesehatan->gula : null;

        if ($gulaDarah === null) {
            $statusDiabetes = 'Data Gula Tidak Tersedia';
        } elseif ($gulaDarah < 140) {
            $statusDiabetes = 'Non Diabetes';
        } elseif ($gulaDarah < 200) {
            $statusDiabetes = 'Waspada';
        } else {
            $statusDiabetes = 'Diabetes';
        }

        // Menyesuaikan tampilan berdasarkan role user
        $view = $user->hasRole('admin') ? 'admin.profile' : 'user.profile';

        return view($view, [
            'user' => $user,
            'umur' => $umur,
            'statusDiabetes' => $statusDiabetes,
        ]);
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

            $file = $request->file('foto');
            $path = $file->store('foto', 'public');

            $user->foto = $path;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui!');
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
}