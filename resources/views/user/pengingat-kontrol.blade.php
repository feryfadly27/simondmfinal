@extends('layout.card')

@section('title', 'Notifikasi')

@section('content')

@if($pengingat->isEmpty())
<div class="h-full w-full flex justify-start items-center">
  <div
    class="mt-4 w-[150px] h-[150px] flex justify-center items-center">
      <lord-icon
          src="https://cdn.lordicon.com/lltgvngb.json"
          trigger="loop"
          delay="500"
          stroke="light"
          colors="primary:#121331,secondary:#0bb4a6"
          class="w-full h-full">
      </lord-icon>
  </div>
  <p class="text-base font-semibold">Pengingat Belum ditambahkan</p>
</div>

@else

{{-- Jika data ada --}}
<div class="flex flex-col justify-start items-center w-full h-full px-5 rounded-lg mt-4">
  @if(session('success'))
    <div class="flex flex-row w-full text-xs font-semibold text-white justify-center items-center gap-4 bg-green-500 rounded-lg p-2 mb-2">
      {{ session('success') }}
    </div>
  @endif
  
  <div class="flex flex-col w-full gap-2">
  @foreach ($pengingat as $item)
    @if ($item->dibaca)
    <div class="flex flex-row w-full justify-between items-center gap-4 bg-white rounded-lg p-3">
      <i class="fas fa-bell text-[#0BB4A6]"></i>
      <div class="flex flex-row justify-between items-center w-full">
        <div class="flex flex-col">
          <h2 class="text-xs font-bold">{{ $item->judul }}</h2>
          <h3 class="text-sm">{{ $item->pesan }}</h3>
          <h3 class="text-xs mt-2">Tanggal {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</h3>
        </div>
        <i class="fas fa-check-double text text-blue-500"></i>
      </div>
    </div>

    @else
    <div class="flex flex-row w-full justify-between items-center gap-4 bg-red-100 rounded-lg p-3">
      <i class="fas fa-bell text-red-500"></i>
      <div class="flex flex-row justify-between items-center w-full">
        <div class="flex flex-col">
          <h2 class="text-xs font-bold">{{ $item->judul }}</h2>
          <h3 class="text-sm">{{ $item->pesan }}</h3>
          <h3 class="text-xs mt-2">Tanggal {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</h3>
        </div>

        <form action="{{ route('pengingat-kontrol.dibaca', $item->id) }}" method="POST">
          @csrf
          @method('PATCH')
          <button type="submit" class="flex justify-center items-center"><i class="fas fa-check-double text text-gray-400 hover:text-gray-500"></i>
          </button>
        </form>
        
      </div>
    </div>

    @endif
  @endforeach
  </div>

</div>
@endif

@endsection
