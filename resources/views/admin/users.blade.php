@extends('layouts.app')
  
@section('title', 'Data Verifikasi')
@section('content')

<div class="px-4 md:px-10 mx-auto w-full -m-24">
<div class="flex flex-wrap">
<div class="w-full mb-4 px-4">
    <div
      class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
    >
      <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
          <div
            class="relative w-full px-4 max-w-full flex-grow flex-1 flex flex-row gap-2 items-center"
          >
            <h3 class="font-semibold text-lg text-blueGray-700">
              Data Verifikasi
            </h3>

          </div>
        </div>
      </div>
      <div class="block w-full overflow-x-auto">
        <!-- Projects table -->
        <table
          class="items-center w-full bg-transparent border-collapse"
        >
          <thead>
            <tr>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Nama Pasien
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Tanggal Lahir
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Umur
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >Aksi</th>
            </tr>
          </thead>
          @php
            use Carbon\Carbon;
          @endphp
          <tbody>
            @foreach($users as $user)
                
            <tr>

              <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 font-bold text-blueGray-600"
              >
                {{ $user->name }}<span class="{{ $user->role == 0 ? 'text-green-500' : 'text-red-500' }} text-[0.7rem]">
                {{ $user->role == 0 ? '(Terverifikasi)' : '(Perlu Verifikasi)' }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                {{ Carbon::parse($user->tanggal_lahir)->translatedFormat('d F Y') }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                {{ ($user->tanggal_lahir)->age }} Tahun
              </td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                @if ($user->role == 0)
                    <i class="fas fa-check-circle w-8 h-8 bg-green-400 hover:bg-green-500 rounded-lg text-white flex items-center justify-center"></i>
                @else
                    <button id="verifikasiBtn{{ $user->id }}">
                        <i class="fas fa-check-circle w-8 h-8 bg-green-400 hover:bg-green-500 rounded-lg text-white flex items-center justify-center"></i>
                    </button>
                    <button id="tolakBtn{{ $user->id }}">
                        <i class="fas fa-times-circle w-8 h-8 bg-red-400 hover:bg-red-500 rounded-lg text-white flex items-center justify-center"></i>
                    </button>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal untuk Verifikasi -->
<div id="verifikasiModal{{ $user->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
      <h1 class="text-xl font-semibold text-center text-black">
        Konfirmasi Verifikasi User
      </h1>
  
      <p class="text-center text-gray-600 mb-4">
        Apakah Anda yakin ingin memverifikasi user ini?
      </p>
  
      <div class="flex justify-center gap-4">
        <button onclick="verifikasiUser({{ $user->id }})"
                class="bg-green-400 hover:bg-green-500 text-white px-5 py-2 rounded-md">Verifikasi</button>
        <button onclick="closeModal('verifikasiModal{{ $user->id }}')"
                class="bg-red-400 hover:bg-red-500 text-white px-5 py-2 rounded-md">Batal</button>
      </div>
    </div>
</div>
  
  <!-- Modal untuk Tolak -->
<div id="tolakModal{{ $user->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
      <h1 class="text-xl font-semibold text-center text-black">
        Tolak Verifikasi User
      </h1>
  
      <p class="text-center text-gray-600 mb-4">
        Apakah Anda yakin ingin menolak verifikasi user ini?
      </p>
  
      <div class="flex justify-center gap-4">
        <button onclick="tolakUser({{ $user->id }})"
                class="bg-red-400 hover:bg-red-500 text-white px-5 py-2 rounded-md">Tolak</button>
        <button onclick="closeModal('tolakModal{{ $user->id }}')"
                class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-md">Batal</button>
      </div>
    </div>
</div>

<script>
    // Fungsi untuk membuka modal
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    // Fungsi untuk memverifikasi user
    function verifikasiUser(userId) {
        fetch('{{ route('admin.verifikasi-user.update', '') }}/' + userId, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ role: 0 }) // Ubah role jadi 0 (terverifikasi)
        }).then(response => response.json())
          .then(data => {
              alert('User berhasil diverifikasi!');
              location.reload(); // Refresh halaman setelah verifikasi
          });
    }

    // Fungsi untuk menolak verifikasi
    function tolakUser(userId) {
        alert('User tetap dalam status perlu verifikasi.');
        location.reload(); // Refresh halaman setelah tolak
    }

    // Menambahkan event listener untuk tombol verifikasi dan tolak
    document.querySelectorAll('[id^="verifikasiBtn"]').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.id.replace('verifikasiBtn', '');
            openModal('verifikasiModal' + userId);
        });
    });

    document.querySelectorAll('[id^="tolakBtn"]').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.id.replace('tolakBtn', '');
            openModal('tolakModal' + userId);
        });
    });

</script>

@endsection
