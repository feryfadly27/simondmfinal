@extends('layout.app')
@section('content')
<section
    class="h-[100vh] w-[350px] m-auto overflow-hidden scale-90 bg-cover bg-center rounded-3xl flex flex-col bg-white p-5">
    <a href="{{route('login')}}" class="rounded-md mt-2 text-white bg-[#0BB4A6] flex flow-row gap-2 items-center px-2 py-1 justify-center w-1/4">
        <svg width="12" height="13" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.5502 10L10.9002 17.35C11.1502 17.6 11.2712 17.8917 11.2632 18.225C11.2552 18.5583 11.1259 18.85 10.8752 19.1C10.6245 19.35 10.3329 19.475 10.0002 19.475C9.66753 19.475 9.37586 19.35 9.1252 19.1L1.4252 11.425C1.2252 11.225 1.0752 11 0.975195 10.75C0.875195 10.5 0.825195 10.25 0.825195 10C0.825195 9.75 0.875195 9.5 0.975195 9.25C1.0752 9 1.2252 8.775 1.4252 8.575L9.1252 0.874999C9.3752 0.624999 9.6712 0.503999 10.0132 0.511999C10.3552 0.519999 10.6509 0.649333 10.9002 0.899999C11.1495 1.15067 11.2745 1.44233 11.2752 1.775C11.2759 2.10767 11.1509 2.39933 10.9002 2.65L3.5502 10Z" fill="white"/>
            </svg>                        
        Login            
    </a>
    
    <h1 class="text-3xl font-bold text-center text-[#0BB4A6] mt-10">Lupa Password</h1>
    <p class="text-center mt-5 text-[0.8rem] text-gray-500">Masukkan akun email Anda <br> untuk mengatur ulang password</p>

    <!-- Session Status -->
    @if (session('status'))
    <div class="text-sm font-medium hidden">
        {{ session('status') }}
    </div>
    <div class="mt-3 text-xs font-medium text-white bg-green-600 p-2 rounded-lg text-center">
        Cek Email Anda untuk mereset password
    </div>
    @endif

    <!-- Form untuk lupa password -->
    <form class="mt-4 flex flex-col justify-between h-full gap-2" method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <input type="email" name="email"
            class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="you@gmail.com" required autofocus>

        <!-- Error Message -->
        @if ($errors->has('email'))
        <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
        @endif

        <!-- Submit Button -->
        <button type="submit"
            class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-5 w-full text-center text-white">Submit</button>
    </form>
</section>
@endsection