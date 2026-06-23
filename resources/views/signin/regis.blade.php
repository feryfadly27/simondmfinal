@extends('layout.app')

@section('content')

<section
    class="container-snap h-[100vh] w-[350px] m-auto overflow-hidden overflow-y-auto bg-[#0BB4A6] scale-90 bg-cover bg-center rounded-3xl flex flex-col p-5">
    <h1 class="text-2xl font-bold text-center text-black mt-3">Daftar</h1>
    <form class="mt-4 flex flex-col gap-3" method="POST" action="{{ route('register') }}">
        @csrf

        @if ($errors->any())
    <div class="p-4 rounded-md text-xs bg-red-100 text-red-700 border border-red-300">
        <strong>Ups!</strong>
        @if ($errors->count() <= 3)
                    <ul class="list-disc list-inside text-sm mt-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-xs">{{ $error }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-xs">Tidak Boleh Ada yang Kosong!</p>
                @endif
            </div>
        @endif


        <!-- NIK -->
        <input id="nik" type="text" name="nik"
            oninput="this.value = this.value.slice(0, 16)"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="NIK (16 Angka)" value="{{ old('nik') }}">
        
        <!-- Nama -->    
        <input id="name" type="text" name="name"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="Nama Lengkap" value="{{ old('name') }}" autocomplete="name">

        <!-- Alamat -->
        <input id="alamat" type="text" name="alamat"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="Alamat" value="{{ old('alamat') }}">

        <!-- Tanggal Lahir -->
        <input id="tanggal_lahir" type="date" name="tanggal_lahir"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
            value="{{ old('tanggal_lahir') }}">
        
        <div class="flex flex-row gap-3">
            <!-- Tinggi Badan -->
            <input id="tinggi_badan" type="number" name="tinggi_badan"
                class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
                placeholder="Tinggi Badan" value="{{ old('tinggi_badan') }}">

            <!-- Berat Badan -->
            <input id="berat_badan" type="number" name="berat_badan"
                class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
                placeholder="Berat Badan" value="{{ old('berat_badan') }}">
        </div>

        <!-- Jenis Kelamin -->
        <select id="jenis_kelamin" name="jenis_kelamin"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
        >
            <option value="" disabled selected>Pilih Jenis Kelamin</option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select>

        <!-- No. Telepon -->
        <input id="no_hp" type="text" name="no_hp"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="No. Telepon (Min. 8 karakter)" value="{{ old('no_hp') }}">

        <!-- Email -->
        <input id="email" type="text" name="email"
            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="you@gmail.com" value="{{ old('email') }}" autocomplete="email">

        <!-- Password -->
        <div class="relative w-full">
            <input id="password" type="password" name="password"
                class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1 pr-10"
                placeholder="Password (Min. 8 karakter)" autocomplete="new-password">
            
            <span onclick="togglePassword('password', 'eyeIcon3')"
                class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                <i id="eyeIcon3" class="fas fa-eye text-gray-400"></i>
            </span>
        </div>
            
        <!-- Konfirmasi Password -->
        <div class="relative w-full">
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black block w-full rounded-md sm:text-sm focus:ring-1 pr-10"
                placeholder="Ulangi Password" autocomplete="new-password">
            
            <span onclick="togglePassword('password_confirmation', 'eyeIcon4')"
                class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                <i id="eyeIcon4" class="fas fa-eye text-gray-400"></i>
            </span>
        </div>
                    
        <!-- Button -->
        <button type="submit"
            class="bg-white px-5 py-2 rounded-md font-bold w-full text-center text-black">DAFTAR</button>
    </form>

    <p class="text-center mt-4 text-[0.8rem] font-medium text-black">Sudah punya akun?
        <a href="{{ route('login') }}" class="font-bold text-white">Login</a>
    </p>
</section>

<!-- Tambahkan FontAwesome jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Tambahkan Script untuk Toggle Password -->
<script>
    function togglePassword(inputId, iconId) {
        let input = document.getElementById(inputId);
        let icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection