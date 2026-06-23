@extends('layout.app')
@section('content')

<section
    class="h-[730px] w-[350px] m-auto overflow-hidden bg-slate-100 bg-cover bg-center rounded-3xl flex flex-col container-snap overflow-y-auto scale-90">

    <!-- Popup Modal Setelah Login -->
    <div id="popupModal" class="fixed inset-0 flex flex-col items-center justify-center bg-[#0BB4A6] z-50 p-4 text-center hidden">
        <h2 class="text-2xl mb-4" style="font-family: 'Righteous', sans-serif">Selamat Datang di<br>SIMON-DM!!</h2>
        <p class="mb-4 text-xl" style="font-family: 'Ranchers', sans-serif">
            Saatnya cek gula darah<br>
            Anda! Jangan lupa<br>
            catat hasilnya untuk<br>
            memantau kesehatan<br>
            Anda</p>
        <button onclick="closePopup()" class="bg-white font-semibold text-black px-4 py-2 rounded-lg">Lanjutkan</button>
    </div>
    <div class="sticky top-0 bg-[#0BB4A6] w-full px-7 py-[8px] flex flex-row items-center justify-between">
        <div class="flex flex-col">
            <h1 class="text-lg text-start font-bold text-black">Halo, {{ $user->name }}</h1>
            <h2 class="mt-[-4px] text-sm">Pasien</h2>
        </div>
        <a href="{{ route('pengingat-kontrol.index') }}">
            <i class="relative fas fa-bell text-2xl text-black hover:text-gray-600">
                @if ($totalKontrol > 0)
                    <span class="flex justify-center items-center h-4 w-4 absolute -top-0.5 -right-1 rounded-full bg-red-500 text-[0.6rem] text-white font-semibold p-1.5">{{ $totalKontrol }}</span>
                @endif
            </i>
        </a>
    </div>

    <h1 class="font-semibold mt-3 text-sm text-center">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</h1>

    <div class="flex flex-row items-center gap-1.5 px-5 mt-2">
        <div class="h-3 w-3 rounded-full
        bg-{{ 
            $statusDiabetes == 'Waspada' ? 'yellow-500' : 
            ($statusDiabetes == 'Non Diabetes' ? 'green-500' : 
            ($statusDiabetes == 'Diabetes' ? 'red-500' : 'black'))
        }}"></div>
        <h1 class="text-start text-sm font-semibold
        text-{{ 
            $statusDiabetes == 'Waspada' ? 'yellow-500' : 
            ($statusDiabetes == 'Non Diabetes' ? 'green-500' : 
            ($statusDiabetes == 'Diabetes' ? 'red-500' : 'black'))
        }}">{{ $statusDiabetes }}</h1>
    </div>

    <div class="flex flex-row items-center gap-1.5 px-[38px] mt-0.5">
        <div class="flex flex-col">
            <h2 class="text-xs">Gula Darah</h2>
            <h2 class="text-xs">Sis/Dias</h2>
            <h2 class="text-xs">IMT</h2>
        </div>
        <div class="flex flex-col">
            <h2 class="text-xs">:</h2>
            <h2 class="text-xs">:</h2>
            <h2 class="text-xs">:</h2>
        </div>
        <div class="flex flex-col">
            <h2 class="text-xs">{{ $catatanKesehatan->gula ?? 0 }} mg/dL</h2>
            <h2 class="text-xs">{{ $catatanKesehatan->sistolik ?? 0 }}/{{ $catatanKesehatan->diastolik ?? '0' }} mmHg</h2>
            @php
                $imt = $catatanKesehatan && $catatanKesehatan->berat && $catatanKesehatan->tinggi 
                    ? $catatanKesehatan->berat / (($catatanKesehatan->tinggi / 100) ** 2) 
                    : 0;
                    $keterangan = '';
                if ($imt < 18.5 && $imt >= 17) {
                    $keterangan = 'Kurus';
                } elseif ($imt >= 18.5 && $imt <= 25) {
                    $keterangan = 'Normal';
                } elseif ($imt > 25 && $imt <= 27) {
                    $keterangan = 'Gemuk';
                } elseif ($imt > 27) {
                    $keterangan = 'Obesitas';
                } else {
                    $keterangan = 'None';
                }
            @endphp
            <h2 class="text-xs">{{ number_format($imt, 2) }} ({{ $keterangan }})</h2>
        </div>
    </div>


    <div class="grid grid-cols-3 grid-rows-2 gap-y-4 gap-x-2 mt-5 w-full p-5 bg-[#0BB4A6] rounded-2xl">
        <!-- Pengingat Obat -->
        <div class="flex flex-col gap-2 items-center">
            <a href="{{route('kesehatan')}}"
                class="bg-white rounded-xl flex flex-col justify-center items-center p-2 w-11/12">
                <i class="fas fa-briefcase-medical text-3xl"></i>
                    
                <p class="text-[0.7rem] text-center mt-2">Rekam Kesehatan</p>
            </a>
        </div>

        <!-- Tanya Dokter -->
        <div class="flex flex-col gap-2 items-center">
            <a href="{{route('pola.makan')}}"
                class="bg-white rounded-xl flex flex-col justify-center items-center p-2 w-11/12">
                <i class="fas fa-hamburger text-3xl"></i>
                    
                <p class="text-[0.7rem] text-center mt-2">Pilihan Pola Makan</p>
            </a>
        </div>

        <!-- Kontrol Pola Makan -->
        <div class="flex flex-col gap-2 items-center">
            <a href="{{ route('dokter') }}"
                class="bg-white rounded-xl flex flex-col justify-center items-center p-2 w-11/12">
                <i class="fas fa-user-md text-3xl"></i>
                    
                <p class="text-[0.7rem] text-center mt-2">Konsultasi Dokter</p>
            </a>
        </div>

        <!-- Kontrol Aktivitas Fisik -->
        <div class="flex flex-col gap-2 items-center">
            <a href="{{ route('kontrol.aktivitas') }}"
                class="bg-white rounded-xl flex flex-col justify-center items-center p-2 w-11/12">
                <i class="fas fa-dumbbell text-3xl"></i>
                    
                <p class="text-[0.7rem] text-center mt-2">Kontrol Olahraga</p>
            </a>
        </div>

        <!-- Catatan Kesehatan -->
        <div class="flex flex-col gap-2 items-center">
            <a href="{{route('pengingatObat')}}"
                class="bg-white rounded-xl flex flex-col justify-center items-center p-2 w-11/12">
                <i class="fas fa-capsules text-3xl"></i>
                    
                <p class="text-[0.7rem] text-center mt-2">Pengingat Obat</p>
            </a>
        </div>

        <!-- Dukungan Sosial -->
        <div class="flex flex-col gap-2 items-center">
            <a href="{{route('reminder')}}"
                class="bg-white rounded-xl flex flex-col justify-center items-center p-2 w-11/12">
                <i class="fas fa-heartbeat text-3xl"></i>
                    
                <p class="text-[0.7rem] text-center mt-2">Daily Reminder</p>
            </a>
        </div>

    </div>

    @php
        $currentRoute = Route::currentRouteName();
    @endphp
        <div class=" absolute bottom-0 p-3 items-center justify-between z-20 w-full">
        
            <div class="bg-white w-full px-2 py-5 items-center rounded-2xl justify-between grid grid-cols-4 text-gray-400 text-xl">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home flex items-center justify-center 
                        {{ $currentRoute == 'dashboard' ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-gray-300 hover:text-gray-500' }}">
                    </i>
                </a>
            
                <!-- Riwayat -->
                <a href="{{ route('riwayat') }}">
                    <i class="fas fa-notes-medical flex items-center justify-center 
                        {{ $currentRoute == 'riwayat' ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-gray-300 hover:text-gray-500' }}">
                    </i>
                </a>
            
                <!-- Profile -->
                <a href="{{ route('profile') }}">
                    <i class="fas fa-user-circle flex items-center justify-center 
                        {{ $currentRoute == 'profile' ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-gray-300 hover:text-gray-500' }}">
                    </i>
                </a>
            
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" onsubmit="resetPopupOnLogout()" class="flex items-center justify-center">
                    @csrf
                    <button type="submit" class="flex flex-row justify-center items-center gap-2">
                        <i class="fas fa-sign-out-alt text-gray-300 hover:text-gray-500"></i>
                    </button>
                </form>      
            </div>
        </div>

</section>

@endsection


{{-- <li class="inline-block relative">
              <a
                class="text-blueGray-500 block py-1 px-3"
                href="#pablo"
                onclick="openDropdown(event,'notification-dropdown')"
                ><i class="fas fa-bell"></i
              ></a>
              <div
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="notification-dropdown"
              >
                <a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Haha</a
                ><a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Another action</a
                ><a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Something else here</a
                >
                <div
                  class="h-0 my-2 border border-solid border-blueGray-100"
                ></div>
                <a
                  href="#pablo"
                  class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
                  >Seprated link</a
                >
              </div>
            </li> --}}