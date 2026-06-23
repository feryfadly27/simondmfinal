@extends('layouts.app')
  
@section('title', 'Data Pasien')
@section('content')

<div class="px-4 md:px-10 mx-auto w-full -m-24">
<div class="flex flex-wrap">
<div class="w-full mb-4 px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
      <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
          <div
            class="relative w-full px-4 max-w-full flex-grow flex-1"
          >
            <h3 class="font-semibold text-lg text-blueGray-700">
              Data Pasien
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
                Alamat
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                No HP
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Email
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Berat Badan
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              >
                Status Diabetes
              </th>
              <th
                class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
              ></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>

              <th
              class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center"
              >
                <img
                  src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/user.svg') }}"
                  class="h-12 w-12 bg-white rounded-full border"
                  alt="..."
                />
                <span class="ml-3 font-bold text-blueGray-600">
                  {{ $user->name }}
                </span>
              </th>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
              {{ $user->alamat }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                {{ $user->no_hp }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                {{ $user->email }}
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                @php
                $tinggiM = ($user->tinggi_badan ?? 1) / 100; // Pastikan tinggi tidak 0
                $jenisKelamin = $user->jenis_kelamin;
                $beratIdeal = $jenisKelamin === 'Pria' ? ($tinggiM * 100) - 100 : ($tinggiM * 100) - 105;
                $statusBerat = '';

                if ($user->berat_badan < $beratIdeal - 5) { $statusBerat='Kurang' ; $weightColor='text-yellow-500' ; }
                    elseif ($user->berat_badan > $beratIdeal + 5) {
                    $statusBerat = 'Berlebih';
                    $weightColor = 'text-red-500';
                    } else {
                    $statusBerat = 'Ideal';
                    $weightColor = 'text-green-500';
                    }
                    @endphp
                    {{ number_format($beratIdeal) }} KG - <span class="{{ $weightColor }}">{{ $statusBerat }}</span>
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
              >
                @php
                $gula = $user->catatanKesehatan->gula ?? 0;
                $kategoriDiabetes = '';
                $borderColor = '';
              
                if ($gula < 140) { $kategoriDiabetes='Non Diabetes' ; $borderColor='text-green-500' ; } elseif ($gula <
                    200) { $kategoriDiabetes='Waspada' ; $borderColor='text-yellow-400' ; } else {
                    $kategoriDiabetes='Diabetes' ; $borderColor='text-red-500' ; } @endphp <span
                    class="{{ $borderColor }}">{{ $kategoriDiabetes }}</span>

                <p> Gula Darah : {{ $gula }} mg/dL</p>
              
              </td>
              <td
                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right"
              >
                <a
                  href="#pablo"
                  class="text-blueGray-500 block py-1 px-3"
                  onclick="openDropdown(event,'table-light-{{ $user->id }}-dropdown')"
                >
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div
                  class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                  id="table-light-{{ $user->id }}-dropdown"
                >
                  <a
                    href="{{ route('admin.detail', ['id' => $user->id]) }}"
                    class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                    >Lihat Detail</a
                  >
                </div>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
