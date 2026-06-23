@extends('layouts.app')

@section('title', 'Detail Pasien')
@section('content')
<div class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="flex flex-wrap">
        <div class="w-full mb-4 px-4">
            <div class="relative flex flex-col min-w-0 px-2 pt-2 pb-4 break-words w-full mb-6 shadow-md rounded-2xl bg-white">
              <a href="{{ route('admin.data-pasien') }}" class="absolute left-5 top-5 text-white text-xs flex flex-row items-center justify-center gap-2 px-2 py-1 bg-[#0BB4A6] hover:bg-[#27a399] font-semibold rounded-lg">
                <i class="fas fa-chevron-left text-white text-sm"></i>
                Kembali
              </a>
              <img src="{{ asset('assets/bg-vector.jpg') }}" alt="bg-vector" class="w-full rounded-xl object-cover h-36">
              <div class="-mt-16 ml-5 flex flex-col lg:flex-row gap-3 lg:gap-20">
                  <div class="flex flex-col">
                      <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/user.svg') }}" alt="User Profile" class="rounded-full h-32 w-32 object-cover bg-white p-2">
                      <h3 class="text-2xl font-semibold leading-normal mt-2 text-blueGray-700">{{ $user->name }}</h3>
                      <h1 class="text-base text-blueGray-400 leading-normal mb-2">{{ $user->email }}</h1>
                      
                      <div class="flex flex-row items-center gap-5">
                          <div class="flex flex-col">
                              <h1 class="text-xs text-blueGray-400">Berat Badan</h1>
                              <h1 class="font-semibold text-sm">{{ $user->tinggi_badan }} CM</h1>
                          </div>
                          <div class="flex flex-col">
                              <h1 class="text-xs text-blueGray-400">Tinggi Badan</h1>
                              <h1 class="font-semibold text-sm">{{ $user->berat_badan }} KG</h1>
                          </div>
                          <div class="flex flex-col">
                              <h1 class="text-xs text-blueGray-400">Umur</h1>
                              <h1 class="font-semibold text-sm">{{ \Carbon\Carbon::parse($user->tanggal_lahir)->age }} Tahun</h1>
                          </div>
                          <div class="flex flex-col">
                              <h1 class="text-xs text-blueGray-400">Jenis Kelamin</h1>
                              <h1 class="font-semibold text-sm">{{ $user->jenis_kelamin }}</h1>
                          </div>
                      </div>
                  </div>

                  <div class="justify-end flex flex-col w-full lg:w-1/2 gap-2 pr-5">
                    <div class="flex flex-col lg:flex-row gap-3">
                        <div class="px-3 py-2 flex flex-row justify-start items-center gap-3 text-sm border-2 rounded-md w-full">
                            <i class="fas fa-envelope text-blueGray-400 mt-1"></i>
                            {{ $user->email }}
                        </div>
                        <div class="px-3 py-2 flex flex-row justify-start items-center gap-3 text-sm border-2 rounded-md w-full">
                            <i class="fas fa-map-marker-alt text-blueGray-400 mt-1"></i>
                            {{ $user->alamat }}
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row gap-3">
                        <div class="px-3 py-2 flex flex-row justify-start items-center gap-3 text-sm border-2 rounded-md w-full">
                            <i class="fas fa-phone-alt text-blueGray-400 mt-1"></i>
                            {{ $user->nik }}
                        </div>
                        <div class="px-3 py-2 flex flex-row justify-start items-center gap-3 text-sm border-2 rounded-md w-full">
                            <i class="fas fa-id-card text-blueGray-400 mt-1"></i>
                            {{ $user->no_hp }}
                        </div>
                    </div>

                    @if ($catatanKesehatan)
                        <div>
                            <p class="text-xs">Data Terbaru 
                                <span class="font-bold">
                                    {{ $catatanKesehatan->created_at->format('d M Y') }}:
                                </span>
                            </p>
                        </div>
                        <div class="flex flex-col lg:flex-row gap-3">
                            <div class="px-3 py-2 flex flex-row justify-start items-center text-sm border-2 rounded-md w-full">
                                <i class="fas fa-medkit text-blueGray-400 mt-1 mr-3"></i>
                                @php
                                $gula = $catatanKesehatan->gula ?? 0;
                                $kategoriDiabetes = '';
                                $borderColor = '';
                
                                if ($gula < 140) { $kategoriDiabetes='Non Diabetes' ; $borderColor='text-green-500' ; } elseif ($gula <
                                    200) { $kategoriDiabetes='Waspada'; $borderColor='text-yellow-400' ; } else {
                                    $kategoriDiabetes='Diabetes' ; $borderColor='text-red-500' ; } @endphp <span
                                    class="{{ $borderColor }}">{{ $kategoriDiabetes }}&nbsp;</span>
                                {{ $gula }} mg/dL
                            </div>
                            <div class="px-3 py-2 flex flex-row justify-start items-center text-sm border-2 rounded-md w-full">
                                <i class="fas fa-weight text-blueGray-400 mt-1 mr-3"></i>
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
                                {{ number_format($beratIdeal) }} KG - <span class="{{ $weightColor }}">&nbsp;{{ $statusBerat }}</span>
                            </div>
                        </div>
                    @else
                        <p class="text-xs font-semibold">Belum ada Rekam Kesehatan terbaru.</p>
                        <div class="flex flex-col lg:flex-row gap-3">
                            <div class="px-3 py-2 flex flex-row justify-start items-center text-sm border-2 rounded-md w-full">
                                <i class="fas fa-medkit text-blueGray-400 mt-1 mr-3"></i>
                                -
                            </div>
                            <div class="px-3 py-2 flex flex-row justify-start items-center text-sm border-2 rounded-md w-full">
                                <i class="fas fa-weight text-blueGray-400 mt-1 mr-3"></i>
                                -
                            </div>
                        </div>
                    @endif
                  </div>
                
              </div>
        </div>


            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-2xl bg-white">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                        <div class="relative w-full px-4 max-w-full flex-grow flex-1 flex flex-row gap-2 items-center">
                            <h3 class="font-semibold text-lg text-blueGray-700">
                                Riwayat Rekam Kesehatan
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
                        Tanggal
                      </th>
                      <th
                        class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                        >
                        Gula Darah
                    </th>
                    <th
                    class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                      >
                      Sistolik
                      </th>
                      <th
                      class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                      >Diastolik</th>
                      <th
                      class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100"
                      >Status Berat</th>
                    </tr>
                </thead>
                <tbody>
                    @if($riwayatCatatan->isEmpty())
                    <tr>
                        <th colspan="5" class="w-full border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">Belum Ada Data Rekam Kesehatan
                        </th>
                    </tr>
                    
                    @else
        
                    @foreach($riwayatCatatan as $catatan)
                    
                    <tr>
                        
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 font-bold text-blueGray-600">
                            {{ $catatan->created_at->format('d M Y') }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            @php
                                $gula = $catatan->gula ?? 0;
                                $kategoriDiabetes = '';
                                $borderColor = '';
                                if ($gula < 140) {
                                    $kategoriDiabetes = 'Non Diabetes';
                                    $borderColor = 'text-green-500';
                                } elseif ($gula >= 140 && $gula < 200) {
                                    $kategoriDiabetes = 'Waspada';
                                    $borderColor = 'text-yellow-400';
                                } else {
                                    $kategoriDiabetes = 'Diabetes';
                                    $borderColor = 'text-red-500';
                                }
                                @endphp
                            {{ $catatan->gula }} mg/dL <span class="{{ $borderColor }}">({{ $kategoriDiabetes }})</span>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ $catatan->sistolik }} mmHg
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ $catatan->diastolik }} mmHg
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
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
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </table>
                </div>
            </div>  
    </div>
@endsection