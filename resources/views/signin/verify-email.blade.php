@extends('layout.app')
@section('content')
<section
    class="h-[100vh] w-[350px] m-auto overflow-hidden scale-90 bg-cover bg-center rounded-3xl flex flex-col bg-white p-5">
    <h1 class="text-3xl font-bold text-center text-[#FF76CE] mt-10">Verifikasi Email</h1>
    <p class="text-center mt-5 text-[0.8rem] text-gray-500">Terima kasih telah mendaftar! Sebelum memulai, mohon
        verifikasi alamat email Anda dengan mengklik tautan yang kami kirim ke email Anda. Jika Anda belum menerima
        email, kami akan mengirimkannya kembali.</p>

    <!-- Session Status -->
    @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600 text-center">
        Tautan verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat pendaftaran.
    </div>
    @endif

    <div class="mt-7 flex flex-col gap-4">
        <!-- Resend Verification Email -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="bg-[#FF76CE] px-5 py-2 rounded-md font-bold w-full text-center text-white">Kirim Ulang Email
                Verifikasi</button>
        </form>

        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-gray-900 w-full text-center">Keluar</button>
        </form>
    </div>
</section>
@endsection