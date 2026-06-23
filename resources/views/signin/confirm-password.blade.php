@extends('layout.app')
@section('content')
<section
    class="h-[100vh] w-[350px] m-auto overflow-hidden scale-90 bg-cover bg-center rounded-3xl flex flex-col bg-white p-5">
    <h1 class="text-3xl font-bold text-center text-[#FF76CE] mt-10">Konfirmasi Password</h1>
    <p class="text-center mt-5 text-[0.8rem] text-gray-500">Ini adalah area aman dari aplikasi. Mohon konfirmasi
        password Anda sebelum melanjutkan.</p>

    <form class="mt-7 flex flex-col gap-4" method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <input type="password" name="password"
            class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#FF76CE] focus:ring-[#FF76CE] block w-full rounded-md sm:text-sm focus:ring-1"
            placeholder="Password" required autocomplete="current-password" />

        <!-- Display Error Message -->
        @if ($errors->has('password'))
        <div class="text-red-500 text-sm mt-2">{{ $errors->first('password') }}</div>
        @endif

        <!-- Confirm Button -->
        <button type="submit"
            class="bg-[#FF76CE] px-5 py-2 rounded-md font-bold w-full text-center text-white">Konfirmasi</button>
    </form>
</section>
@endsiction