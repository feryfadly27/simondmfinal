@extends('layouts.app')
  
@section('title', 'Data Pengingat')
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
              Data Pengingat
            </h3>
            
            <a href="#" onclick="openModal('modalTambah')" class="px-2 py-1 flex flex-row items-center justify-center text-xs bg-green-500 rounded-md gap-2 text-white hover:bg-green-600">
              <i class="fas fa-plus rounded-lg text-white"></i>
              Tambah Pengingat
            </a>

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
                Judul Pengingat
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Pesan
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Tanggal
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Nama User
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if($pengingatUsers->isEmpty())
            <tr>
              <th colspan="5" class="w-full border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">Data Belum Diisi
              </th>
            </tr>
              
            @else

            @foreach ($pengingatUsers as $index => $pengingat)
                
            <tr>

              <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 font-bold text-blueGray-600"
              >
                {{ $pengingat->judul }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs break-words p-4"
              >
                {{ $pengingat->pesan }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs break-words p-4"
              >
                {{ $pengingat->tanggal }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 flex flex-row items-center gap-2"
              >
              <img
                  src="{{ $pengingat->user->foto ? asset('storage/' . $pengingat->user->foto) : asset('assets/user.svg') }}"
                  class="h-8 w-8 bg-white rounded-full border"
                  alt="..."
                />
                {{ $pengingat->user->name }}
              </td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <div class="flex gap-2">
                  <button onclick="openEditModal(
                    {{ $pengingat->id }},
                    '{{ $pengingat->judul }}',
                    '{{ $pengingat->pesan }}',
                    '{{ \Carbon\Carbon::parse($pengingat->tanggal)->format('Y-m-d') }}',
                    '{{ $pengingat->user->id }}')">

                    <i class="fas fa-edit w-8 h-8 bg-blue-400 hover:bg-blue-500 rounded-lg text-white flex items-center justify-center"></i>
                  </button>
                
                  <button type="button" onclick="openModal('hapusModal{{ $pengingat->id }}')">
                      <i class="fas fa-trash w-8 h-8 bg-pink-500 hover:bg-pink-600 rounded-lg text-white flex items-center justify-center"></i>
                  </button>
                  
                  <!-- Modal Konfirmasi Hapus -->
                  <div id="hapusModal{{ $pengingat->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                      <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
                        <h1 class="text-xl font-semibold text-center text-black">
                          Konfirmasi Hapus Pengingat
                        </h1>
                      
                        <p class="text-center text-gray-600 mb-4">
                          Apakah Anda yakin ingin menghapus pengingat ini?
                        </p>
                      
                        <div class="flex justify-center gap-4">
                          <form action="{{ route('admin.pengingat-user.destroy', $pengingat->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md">
                              Hapus
                            </button>
                          </form>
                      
                          <button onclick="closeModal('hapusModal{{ $pengingat->id }}')" class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-md">
                            Batal
                          </button>
                        </div>
                      </div>
                   </div>

                </div>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Modal Tambah Pengingat --}}
<div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
      <h1 class="text-xl font-semibold text-center text-black">
          Tambah Pengingat
      </h1>

      <!-- Form di dalam modal -->
      <form class="mt-4 flex flex-col gap-2" action="{{ route('admin.pengingat-user.store') }}" method="POST">
          @csrf
          <select name="judul"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
              <option disabled selected>Pilih Pengingat</option>
              <option value="Pemberitahuan Jadwal Prolanis">Pemberitahuan Jadwal Prolanis</option>
              <option value="Pemberitahuan Kontrol Rutin Bulanan">Pemberitahuan Kontrol Rutin Bulanan</option>
          </select>

          <select name="user_id"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
              <option disabled selected>Pilih User</option>
              <option value="all">Semua Pasien</option>
              @foreach ($users as $user)
                @continue($user->role == 1)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
          </select>

          <input type="text" name="pesan"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Masukan Pesan"/>

          <label class="mt-1 text-xs">Tanggal</label>
          <input type="date" name="tanggal"
              class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"/>

          <!-- Tombol Submit dan Batal -->
          <button type="submit"
              class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-1 w-full text-center text-white">
              Simpan
          </button>
          <button type="button"
              class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold mt-1 w-full text-center text-[#0BB4A6]"
              onclick="closeModal('modalTambah')">
              Batal
          </button>
      </form>
  </div>
</div>

{{-- Modal Edit Obat --}}
<div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
      <h1 class="text-xl font-bold text-center text-[#0BB4A6]">
          Tambah Stok Obat
      </h1>

      <!-- Form di dalam modal -->
      <form class="mt-4 flex flex-col gap-2" id="formEditPengingat" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="editId">

          <label class="text-xs">Pengingat</label>
          <select name="judul" id="editPengingat"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
              <option value="Pemberitahuan Jadwal Prolanis">Pemberitahuan Jadwal Prolanis</option>
              <option value="Pemberitahuan Kontrol Rutin Bulanan">Pemberitahuan Kontrol Rutin Bulanan</option>
          </select>

          <label class="text-xs">Ubah User</label>
          <select name="user_id" id="editUser"
              class="px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
              <option value="all">Semua Pasien</option>
              @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
          </select>

          <label class="text-xs">Pesan</label>
          <input type="text" name="pesan" id="editPesan"
              class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Edit Pesan"/>

          <label class="text-xs">Tanggal</label>
          <input type="date" name="tanggal" id="editTanggal"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"/>

          <!-- Tombol Submit dan Batal -->
          <button type="submit"
              class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-1 w-full text-center text-white">
              Simpan
          </button>
          <button type="button"
              class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold mt-1 w-full text-center text-[#0BB4A6]"
              onclick="closeModal('modalEdit')">
              Batal
          </button>
      </form>
  </div>
</div>

{{-- Script Modal --}}


<script>
  function openModal(id) {
      document.getElementById(id).classList.remove('hidden');
  }
  
  function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
  }

    function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
  }
  
  function openEditModal(id, judul, pesan, tanggal, user_id) {
    document.getElementById('editId').value = id;
    document.getElementById('editPengingat').value = judul;
    document.getElementById('editPesan').value = pesan;
    document.getElementById('editTanggal').value = tanggal;
    document.getElementById('editUser').value = user_id.toString();

    let formEdit = document.getElementById('formEditPengingat');
    formEdit.action = `/admin/pengingat-user/update/${id}`;

    openModal('modalEdit');
  }
    
  </script>

@endsection
