@extends('layout.app')
@section('content')
<section
    class="h-[730px] w-[350px] m-auto overflow-hidden bg-slate-100 bg-cover bg-center rounded-3xl flex flex-col items-center container-snap overflow-y-auto scale-90">

    <div class="sticky top-0 bg-[#0BB4A6] w-full px-7 py-[18px] flex flex-row items-center justify-center">
        <h1 class="text-base text-center font-bold text-black">Riwayat Pemeriksaan</h1>
        <a href="{{ route('pengingat-kontrol.index') }}" class="absolute right-7">
            <i class="relative fas fa-bell text-2xl text-black hover:text-gray-600">
                @if ($totalKontrol > 0)
                    <span class="flex justify-center items-center h-4 w-4 absolute -top-0.5 -right-1 rounded-full bg-red-500 text-[0.6rem] text-white font-semibold p-1.5">{{ $totalKontrol }}</span>
                @endif
            </i>
        </a>
    </div>

    <div class="w-full flex flex-col px-5 mt-4 gap-2">
      @if ($catatanKesehatan->isNotEmpty())
          @foreach ($catatanKesehatan as $catatan)
            @php
            $gula = $catatan->gula ?? 0;
            if ($gula < 140)
            { 
                $kategoriDiabetes='Non Diabetes' ;
                $borderColor = 'text-green-500';
            }

            elseif ($gula < 200)
            {
                $kategoriDiabetes='Waspada' ;
                $borderColor = 'text-yellow-400';

            }
            else {
                $kategoriDiabetes='Diabetes' ;
                $borderColor = 'text-red-500';
            }
            @endphp

            {{-- Logika IMT --}}
            @php
            $imt = $catatan && $catatan->berat && $catatan->tinggi 
                ? $catatan->berat / (($catatan->tinggi / 100) ** 2) 
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

            {{-- Logika Berat Badan --}}
            @php
            $tinggiM = ($catatan->tinggi ?? 1) / 100; // Pastikan tinggi tidak 0
            $berat = $catatan->berat ?? 0;

            // Hitung IMT
            $imT = $berat / ($tinggiM * $tinggiM);

            // Ambil data umur dan jenis kelamin
            $umur = \Carbon\Carbon::parse($user->tanggal_lahir)->age;
            $jenisKelamin = $user->jenis_kelamin;

            // Hitung berat badan ideal berdasarkan jenis kelamin
            if ($jenisKelamin === 'L') {
            $beratIdeal = ($tinggiM * 100) - 100; // Berat ideal = tinggi badan (cm) - 100
            } else {
            $beratIdeal = ($tinggiM * 100) - 105; // Berat ideal = tinggi badan (cm) - 105
            }

            $statusBeratBadan = '';
             if ($imT < 18.5) { $statusBeratBadan='Kekurangan' ; } elseif ($imT>= 18.5 && $imT < 24.9) {
                     $statusBeratBadan='Ideal' ; } elseif ($imT>= 25 && $imT < 29.9) { $statusBeratBadan='Kelebihan' ; }
                         else { $statusBeratBadan='Obesitas' ; } @endphp

              <!-- Tampilkan setiap catatan -->
            <div class="w-full border px-3 py-2 flex flex-col justify-between items-center">
                <div class="w-full flex flex-row justify-between items-center">
                    <div class="flex flex-row justify-center items-center gap-2 font-semibold">
                        <p class="text-sm">{{ $loop->iteration }} .</p>
                        <p class="text-sm">{{ $catatan->created_at->format('d/m/Y') }}</p>
                    </div>
                    
                    <div class="flex flex-row justify-center items-center">
                        <a href="#" class="p-2 rounded-lg"
                        onclick="openDetail('{{ $catatan->umur }}', '{{ $catatan->gula }}', '{{ $catatan->sistolik }}', '{{ $catatan->diastolik }}', '{{ $catatan->tinggi }}', '{{ $berat }}', '{{ $statusBeratBadan }}', '{{ $keterangan }}', '{{ $imt }}', '{{ $kategoriDiabetes }}')">
                      <svg width="20" height="18" viewBox="0 0 22 18" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                          <path
                          d="M8 1.45962C8.91153 1.16968 9.9104 1 11 1C15.1819 1 18.028 3.49956 19.7251 5.70433C20.575 6.80853 21 7.3606 21 9C21 10.6394 20.575 11.1915 19.7251 12.2957C18.028 14.5004 15.1819 17 11 17C6.81811 17 3.97196 14.5004 2.27489 12.2957C1.42496 11.1915 1 10.6394 1 9C1 7.3606 1.42496 6.80853 2.27489 5.70433C2.75612 5.07914 3.32973 4.43025 4 3.82137"
                          stroke="#000000" stroke-opacity="0.807843" stroke-width="1.5"
                          stroke-linecap="round" />
                          <path
                          d="M14 9C14 10.6569 12.6569 12 11 12C9.3431 12 8 10.6569 8 9C8 7.3431 9.3431 6 11 6C12.6569 6 14 7.3431 14 9Z"
                          stroke="#000000" stroke-opacity="0.807843" stroke-width="1.5" />
                        </svg>
                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('riwayat.destroy', $catatan->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                      @method('DELETE')
                      <button type="submit" class="rounded-lg flex justify-center items-center">
                          <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                          xmlns="http://www.w3.org/2000/svg" class="scale-110">
                          <path d="M13.2951 3.55666H0.705566" stroke="#000000" stroke-width="1.11083"
                          stroke-linecap="round" />
                              <path
                              d="M12.0609 5.40806L11.7202 10.5172C11.5892 12.4833 11.5236 13.4664 10.883 14.0657C10.2425 14.665 9.25722 14.665 7.28675 14.665H6.71408C4.74357 14.665 3.75834 14.665 3.11775 14.0657C2.47717 13.4664 2.41163 12.4833 2.28055 10.5172L1.93994 5.40806"
                                  stroke="#000000" stroke-width="1.11083" stroke-linecap="round" />
                              <path d="M5.14893 7.25945L5.5192 10.9622" stroke="#000000" stroke-width="1.11083"
                              stroke-linecap="round" />
                              <path d="M8.85172 7.25945L8.48145 10.9622" stroke="#000000" stroke-width="1.11083"
                              stroke-linecap="round" />
                              <path
                                  d="M2.92725 3.55667C2.96863 3.55667 2.98932 3.55667 3.00808 3.55619C3.61788 3.54074 4.15584 3.153 4.36335 2.57937C4.36973 2.56172 4.37627 2.5421 4.38935 2.50283L4.46126 2.28714C4.52263 2.10301 4.55332 2.01095 4.59402 1.93278C4.75643 1.62091 5.05689 1.40434 5.40412 1.3489C5.49115 1.335 5.58821 1.335 5.78231 1.335H8.21829C8.41239 1.335 8.50948 1.335 8.5965 1.3489C8.94374 1.40434 9.24419 1.62091 9.40659 1.93278C9.44732 2.01095 9.47798 2.10301 9.53937 2.28714L9.61128 2.50283C9.62431 2.54205 9.6309 2.56174 9.63727 2.57937C9.84478 3.153 10.3827 3.54074 10.9926 3.55619C11.0113 3.55667 11.032 3.55667 11.0734 3.55667"
                                  stroke="#000000" stroke-width="1.11083" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="w-full flex flex-row gap-1.5 justify-start items-start">
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
                        <h2 class="text-xs">{{ $catatan->gula ?? 0 }} mg/dL <span class="font-semibold {{ $borderColor }}">({{ $kategoriDiabetes }})</span></h2>
                        <h2 class="text-xs">{{ $catatan->sistolik ?? 0 }}/{{ $catatan->diastolik ?? '0' }} mmHg</h2>
                        <h2 class="text-xs">{{ number_format($imt, 2) }} ({{ $keterangan }})</h2>
                    </div>
                </div>
            </div>

              <!-- ModalDetail -->
    <div id="myDetail" class="fixed inset-0 z-50 flex flex-col bg-slate-100 hidden">
        <div class="absolute top-0 bg-[#0BB4A6] w-full px-7 py-[18px] flex flex-row items-center justify-between">
            <a onclick="closeDetail()" class="cursor-pointer">
                <svg width="13" height="17" viewBox="0 0 13 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.49896 10.525L11.6722 3.35177C11.9664 3.05752 12.1212 2.70332 12.1204 2.29949C12.1196 1.89648 11.9652 1.54283 11.6727 1.24869C11.3795 0.953986 11.0231 0.796625 10.6143 0.787062C10.2014 0.777404 9.84013 0.92672 9.54363 1.22322L1.84363 8.92322C1.62092 9.14593 1.4515 9.39913 1.33829 9.68215C1.2274 9.95938 1.17041 10.2408 1.17041 10.525C1.17041 10.8092 1.2274 11.0906 1.33829 11.3678C1.4515 11.6509 1.62092 11.9041 1.84363 12.1268L1.84392 12.1271L9.54387 19.802C9.83807 20.0954 10.192 20.25 10.5954 20.25C10.9988 20.25 11.3528 20.0954 11.647 19.802C11.9401 19.5097 12.0987 19.1579 12.1083 18.756C12.1181 18.3498 11.9673 17.9933 11.6722 17.6982L4.49896 10.525Z" fill="black" stroke="black" stroke-width="0.5"/>
                </svg>                              
            </a>
            <div class="flex flex-col">
                <h1 class="text-base text-center font-bold text-black ml-2">Riwayat Pemeriksaan</h1>
            </div>
            <form method="POST" action="{{ route('logout') }}" onsubmit="resetPopupOnLogout()">
                @csrf
                <button type="submit" class="flex flex-row justify-center items-center gap-2">
                    <svg width="32" height="25" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9427 3.31241C12 4.17454 12 5.75166 12 8.90454V24.0955C12 27.2484 12 28.8255 12.9427 29.6877C13.8853 30.5498 15.3267 30.2913 18.2093 29.7729L21.316 29.2147C24.508 28.6399 26.104 28.3525 27.052 27.1453C28 25.9367 28 24.1904 28 20.6965V12.3035C28 8.81104 28 7.06479 27.0533 5.85616C26.104 4.64891 24.5067 4.36154 21.3147 3.78816L18.2107 3.22854C15.328 2.71016 13.8867 2.45166 12.944 3.31379M16 13.9824C16.552 13.9824 17 14.465 17 15.0604V17.9397C17 18.535 16.552 19.0177 16 19.0177C15.448 19.0177 15 18.535 15 17.9397V15.0604C15 14.465 15.448 13.9824 16 13.9824Z" fill="black"/>
                        <path d="M10.0627 6.1875C7.31867 6.19162 5.888 6.2535 4.976 7.194C4 8.2005 4 9.82025 4 13.0625V19.9375C4 23.1784 4 24.7981 4.976 25.806C5.888 26.7451 7.31867 26.8084 10.0627 26.8125C10 25.9545 10 24.9645 10 23.8934V9.10663C10 8.03413 10 7.04413 10.0627 6.1875Z" fill="black"/>
                        </svg>
                </button>
            </form>          
        </div>


        <h1 class="text-base font-bold text-center text-black mt-[66px]">
            {{ $catatan->created_at->format('d M Y') }}
        </h1>
        <div class="mt-3 flex flex-col gap-2 text-start px-7">
            <div class="flex flex-row gap-2">
                <div class="flex flex-col">
                    <p class="text-sm">Umur</p>
                    <p class="text-sm">Gula Darah</p>
                    <p class="text-sm">Sistolik</p>
                    <p class="text-sm">Diastolik</p>
                    <p class="text-sm">Berat Badan</p>
                    <p class="text-sm">Tinggi Badan</p>
                    <p class="text-sm">IMT</p>
                    <p class="text-sm">Status</p>
                </div>

                <div class="flex flex-col">
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                    <p class="text-sm">:</p>
                </div>

                <div class="flex flex-col">
                    <p class="text-sm" id="umur"></p>
                    <p class="text-sm" id="gula"></p>
                    <p class="text-sm" id="sistolik"></p>
                    <p class="text-sm" id="diastolik"></p>
                    <p class="text-sm" id="berat"></p>
                    <p class="text-sm" id="tinggi"></p>
                    <p class="text-sm" id="imt"></p>
                    <p class="text-sm" id="kategori"></p>
                </div>
            </div>
        </div>
    </div>
              
          @endforeach
      @else
          <!-- Jika tidak ada data -->
          <div class="w-full flex flex-col justify-center items-center">
              <div class="mt-4 w-[150px] h-[150px] flex justify-center items-center">
                  <lord-icon
                      src="https://cdn.lordicon.com/lltgvngb.json"
                      trigger="loop"
                      delay="500"
                      stroke="light"
                      colors="primary:#121331,secondary:#0bb4a6"
                      class="w-full h-full">
                  </lord-icon>
              </div>
              <p class="text-base font-semibold">Tidak Ada Riwayat Pemeriksaan</p>
          </div>
      @endif
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

<script>



function openDetail(umur, gula, sistolik, diastolik, berat, tinggi, statusBerat, keterangan, imt, kategori) {
    // Set detail obat dalam modal
    let imtFormatted = parseFloat(imt).toFixed(2);

    document.getElementById('umur').innerText = umur + ' Tahun';
    document.getElementById('gula').innerText = gula + ' mg/dL';
    document.getElementById('sistolik').innerText = sistolik + ' mmHg';
    document.getElementById('diastolik').innerText = diastolik + ' mmHg';
    document.getElementById('berat').innerText = berat + ' Kg ' + ' (' + statusBerat + ')';
    document.getElementById('tinggi').innerText = tinggi + ' Cm';
    document.getElementById('imt').innerText = imtFormatted + ' (' + keterangan + ')';
    document.getElementById('kategori').innerText = kategori;

    // Tampilkan modal
    document.getElementById("myDetail").classList.remove("hidden");
}

// Fungsi untuk menutup modal
function closeDetail() {
    document.getElementById("myDetail").classList.add("hidden");
}

// Menutup modal jika klik di luar konten modal
window.onclick = function(event) {
    const modal = document.getElementById("myDetail");
    if (event.target === modal) {
        closeDetail();
    }
};
</script>


@endsection
