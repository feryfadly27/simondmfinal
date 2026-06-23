@extends('layout.app')

@section('content')
<section
    class="h-[100vh] w-[350px] m-auto overflow-hidden scale-90 bg-cover bg-center rounded-3xl flex flex-col bg-white">

    <div class="h-[450px] w-full bg-[#0BB4A6] flex flex-row items-center justify-center rounded-b-[3rem]">
        <h1  style="font-family: 'Quintessential', serif;" class="absolute top-24 text-3xl text-black text-center">SELAMAT DATANG <br> <span  style="font-family: 'Quintessential', serif;"
                class="text-center text-base">Di Aplikasi SIMON-DM</span></h1>
    </div>
    
    <div class="px-5 flex">
        <form
        class="h-[400px] w-full bg-white mt-[-12rem] rounded-3xl shadow-lg flex flex-col justify-center items-center px-5 border border-black"
        method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col w-full gap-4">

                @if(session('success'))
                    <div class="bg-green-500 text-white px-1 py-2 rounded-md text-center">
                        <p class="text-xs">
                            {{ session('success') }}
                        </p>
                    </div>
                @elseif(session('error'))
                    <div class="bg-red-500 text-white px-1 py-2 rounded-md text-center">
                        <p class="text-xs">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif

                <h1 id="roleText" class="font-semibold text-center">Silahkan Login Sebagai ...</h1>

                <div class="block">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                        Email
                    </span>
                    <input type="email" name="email"
                        class="mt-1 px-5 py-2 bg-[#0BB4A6] border shadow-sm border-slate-300 placeholder-slate-200 focus:outline-none focus:border-black focus:ring-black block w-full rounded-full sm:text-sm focus:ring-1"
                        placeholder="Masukan Email" required autofocus autocomplete="username" />
                </div>

                <div class="block relative">
                    <span
                        class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                        Password
                    </span>
                    <div class="relative w-full">
                        <input id="password" type="password" name="password"
                            class="mt-1 px-5 py-2 bg-[#0BB4A6] border shadow-sm border-slate-300 placeholder-slate-200 focus:outline-none focus:border-black focus:ring-black block w-full rounded-full sm:text-sm focus:ring-1 pr-10"
                            placeholder="Password" required autocomplete="current-password" />
                        
                        <!-- Ikon Mata -->
                        <span onclick="togglePassword('password', 'eyeIcon')" 
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                            <i id="eyeIcon" class="fas fa-eye text-gray-200"></i>
                        </span>
                    </div>
                </div>

            </div>
            <button type="submit"
                class="bg-[#0BB4A6] px-5 py-2 rounded-full font-semibold mt-12 w-full text-center text-black">Login</button>
            <a href="{{ route('password.request') }}" class="text-gray-500 underline font-medium text-[0.8rem] mt-3">Lupa
                Password?</a>
        </form>
    </div>
    <p class="text-center mt-8 text-[0.8rem] font-medium text-gray-500">Belum punya akun? <a
            href="{{ route('register') }}" class="font-bold text-[#0BB4A6]">Daftar</a></p>
</section>

<!-- Tambahkan FontAwesome jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<script>
    document.addEventListener("DOMContentLoaded", function() {
      let role = localStorage.getItem('userRole') || 'Pengguna';
      document.getElementById("roleText").innerText = "Silahkan Login sebagai " + role;
    });

    // Script untuk Toggle Password
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