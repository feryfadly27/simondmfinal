@extends('layout.app')
@section('content')
<section class="h-[100vh] w-[350px] m-auto overflow-hidden bg-[#0BB4A6] scale-90 bg-cover bg-center rounded-3xl flex flex-col items-center justify-center">
  <div class="flex flex-col gap-8 items-center">
    <h1 class="font-semibold text-[24px] mb-10">Login Sebagai</h1>

    <a href="{{ route('login') }}" onclick="setRole('Petugas')" class="flex flex-col justify-center items-center px-7 py-3 bg-white rounded-[2rem] gap-2">
      <img src="{{ asset('assets/petugas.png') }}" alt="" class="h-[135px]">
      <h1 class="font-semibold text-[23px]">Petugas</h1>
    </a>

    <a href="{{ route('login') }}" onclick="setRole('Pasien')" class="flex flex-col justify-center items-center px-7 py-3 bg-white rounded-[2rem] gap-2">
      <img src="{{ asset('assets/pasien.png') }}" alt="" class="h-[135px]">
      <h1 class="font-semibold text-[23px]">Pasien</h1>
    </a>
  </div>

  </section>

  <script>
    function setRole(role) {
      localStorage.setItem('userRole', role);
    }
  </script>
@endsection
