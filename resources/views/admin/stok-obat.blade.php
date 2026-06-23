@extends('layouts.app')
  
@section('title', 'Data Obat')
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
              Data Obat
            </h3>
            
            <a href="#" onclick="openModal('modalTambah')" class="px-2 py-1 flex flex-row items-center justify-center text-xs bg-green-500 rounded-md gap-2 text-white hover:bg-green-600">
              <i class="fas fa-plus rounded-lg text-white"></i>
              Tambah Obat
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
                Nama Obat
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Jenis Obat
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Takaran
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >Aksi</th>
            </tr>
          </thead>
          <tbody>
            @if($stokObats->isEmpty())
            <tr>
              <th colspan="3" class="w-full border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">Data Belum Diisi
              </th>
            </tr>
              
            @else

            @foreach($stokObats as $obat)
                
            <tr>

              <td
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 font-bold text-blueGray-600"
              >
                  {{ $obat->nama_obat }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                  {{ ucfirst($obat->jenis_obat) }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                  {{ $obat->takaran }}{{ $obat->jenis_obat == 'Sirup' ? ' ml' : ' mg' }}
              </td>
              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                <div class="flex gap-2">
                  <button onclick="openEditModal({{ $obat->id }}, '{{ $obat->nama_obat }}', '{{ $obat->jenis_obat }}', '{{ $obat->takaran }}')">
                    <i class="fas fa-edit pl-0.5 w-8 h-8 bg-blue-400 hover:bg-blue-500 rounded-lg text-white flex items-center justify-center"></i>
                  </button>
                  <button type="button" onclick="openModal('hapusObatModal{{ $obat->id }}')">
                    <i class="fas fa-trash w-8 h-8 bg-pink-500 hover:bg-pink-600 rounded-lg text-white flex items-center justify-center"></i>
                  </button>

                  <!-- Modal Konfirmasi Hapus Obat -->
                  <div id="hapusObatModal{{ $obat->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
                      <h1 class="text-xl font-semibold text-center text-black">
                        Konfirmasi Hapus Obat
                      </h1>
                    
                      <p class="text-center text-gray-600 mb-4">
                        Apakah Anda yakin ingin menghapus obat <strong>{{ $obat->nama }}</strong>?
                      </p>
                    
                      <div class="flex justify-center gap-4">
                        <form action="{{ route('admin.stok-obat.destroy', $obat->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md">Hapus</button>
                        </form>
                        <button onclick="closeModal('hapusObatModal{{ $obat->id }}')" class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-md">Batal</button>
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

{{-- Modal Tambah Obat --}}
<div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
      <h1 class="text-xl font-semibold text-center text-black">
          Tambah Stok Obat
      </h1>

      <!-- Form di dalam modal -->
      <form class="mt-4 flex flex-col gap-2" action="{{ route('admin.stok-obat.store') }}" method="POST">
          @csrf
          <input type="text" name="nama_obat"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Nama Obat" required/>

          <select name="jenis_obat"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
              <!-- <option>Select Kategori</option> -->
              <option value="kapsul">Kapsul</option>
              <option value="tablet">Tablet</option>
              <option value="sirup">Sirup</option>
          </select>

          <input type="number" name="takaran"
              class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Takaran mg/ml"/>

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
      <form class="mt-4 flex flex-col gap-2" id="formEditObat" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="editId">

          <label class="text-xs">Nama Obat</label>
          <input type="text" name="nama_obat" id="editNamaObat"
              class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Nama Obat" required/>

          <label class="text-xs">Kategori Obat</label>
          <select name="jenis_obat" id="editJenisObat"
              class="px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" required>
              <!-- <option>Select Kategori</option> -->
              <option value="kapsul">Kapsul</option>
              <option value="tablet">Tablet</option>
              <option value="sirup">Sirup</option>
          </select>

          <label class="text-xs">Takaran mg/ml</label>
          <input type="number" name="takaran" id="editTakaran"
              class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
              placeholder="Takaran mg/ml"/>

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

  function openEditModal(id, nama, jenis, takaran) {
    document.getElementById('editId').value = id;
    document.getElementById('editNamaObat').value = nama;
    document.getElementById('editJenisObat').value = jenis;
    document.getElementById('editTakaran').value = takaran;

    let formEdit = document.getElementById('formEditObat');
    formEdit.action = `/admin/stok-obat/update/${id}`;

    openModal('modalEdit');
  }
  
</script>
  
@endsection
