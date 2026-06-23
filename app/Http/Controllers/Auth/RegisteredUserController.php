<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('signin.regis');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'alamat' => ['required', 'string'],
            'tinggi_badan' => ['required', 'numeric'],
            'berat_badan' => ['required', 'numeric'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
            'no_hp' => ['required', 'string', 'max:15', 'min:10'], // Tambah validasi min
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik'],
        ],[
            'name.required' => 'Nama tidak boleh kosong.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'tinggi_badan.required' => 'Tinggi badan tidak boleh kosong.',
            'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
            'berat_badan.required' => 'Berat badan tidak boleh kosong.',
            'berat_badan.numeric' => 'Berat badan harus berupa angka.',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.size' => 'NIK harus 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'role' => 2, // Tambahkan ini
        ]);
        // dd($user);

        event(new Registered($user));

        return redirect(route('login'))->with('success', 'Registrasi berhasil! Silahkan hubungi admin untuk verifikasi login!');

    }
}
