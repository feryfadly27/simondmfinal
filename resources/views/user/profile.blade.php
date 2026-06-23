@extends('layout.app')

@section('content')

    <section
        class="h-[730px] w-[350px] m-auto overflow-hidden bg-slate-100 bg-cover bg-center rounded-3xl flex flex-col items-center container-snap overflow-y-auto scale-90">

        <div class="sticky top-0 bg-[#0BB4A6] w-full px-7 py-[18px] flex flex-row items-center justify-center">
            <h1 class="text-base text-center font-bold text-black">My Profile</h1>
            <a href="{{ route('pengingat-kontrol.index') }}" class="absolute right-7">
                <i class="relative fas fa-bell text-2xl text-black hover:text-gray-600">
                    @if ($totalKontrol > 0)
                        <span class="flex justify-center items-center h-4 w-4 absolute -top-0.5 -right-1 rounded-full bg-red-500 text-[0.6rem] text-white font-semibold p-1.5">{{ $totalKontrol }}</span>
                    @endif
                </i>
            </a>
        </div>


        <div class="flex flex-row items-center w-full gap-4 px-7 mt-5">
            <div class="h-full w-2/5 flex flex-row items-center justify-center">
                @if ($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                    class="rounded-full h-full w-full object-cover">
                @else
                <svg width="60" height="55" viewBox="0 0 47 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4999 0.333252C26.5093 0.333239 29.4893 0.893653 32.2697 1.9825C35.0501 3.07134 37.5764 4.66729 39.7045 6.67923C41.8325 8.69116 43.5205 11.0797 44.6722 13.7084C45.8239 16.3371 46.4166 19.1546 46.4166 21.9999C46.4166 33.9661 36.1564 43.6666 23.4999 43.6666C10.8434 43.6666 0.583252 33.9661 0.583252 21.9999C0.583252 10.0338 10.8434 0.333252 23.4999 0.333252ZM25.7916 24.1666H21.2083C15.5348 24.1666 10.6639 27.4153 8.56309 32.0527C11.8871 36.4596 17.3386 39.3333 23.4999 39.3333C29.6612 39.3333 35.1126 36.4596 38.4368 32.0524C36.3359 27.4153 31.4651 24.1666 25.7916 24.1666ZM23.4999 6.83325C19.7029 6.83325 16.6249 9.74343 16.6249 13.3333C16.6249 16.9231 19.7029 19.8333 23.4999 19.8333C27.2968 19.8333 30.3749 16.9231 30.3749 13.3333C30.3749 9.74343 27.2969 6.83325 23.4999 6.83325Z" fill="#0BB4A6"/>
                  </svg>  
                @endif
            </div>
            <div class="flex flex-row justify-between items-center w-full">
                <div class="flex flex-col gap-0.5">
                    <h2 class="text-xs font-bold">{{ $user->name }}</h2>
                    <h2 class="text-xs">{{ $umur }} Tahun</h2>
                    @php
                        $textColor = match($statusDiabetes) {
                            'Non Diabetes' => 'text-green-500',
                            'Waspada' => 'text-yellow-400',
                            'Diabetes' => 'text-red-500',
                            default => 'text-black',
                        };
                    @endphp
                    <h2 class="text-xs">Status : <span class="{{ $textColor }} font-bold">{{ $statusDiabetes }}</span></h2>
                </div>
                <a href="#" class="flex flex-row items-center justify-center" onclick="openModal()">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.09 12.441V16.881C17.0898 17.5092 16.8401 18.1116 16.3959 18.5558C15.9516 19 15.3492 19.2497 14.721 19.25H3.12002C2.80777 19.2499 2.49863 19.188 2.21035 19.068C1.92208 18.9481 1.66035 18.7723 1.44021 18.5509C1.22007 18.3294 1.04586 18.0667 0.927584 17.7777C0.80931 17.4887 0.749306 17.1792 0.751018 16.867V5.27898C0.74916 4.96723 0.809194 4.6582 0.927639 4.36982C1.04608 4.08144 1.22059 3.81944 1.44103 3.59899C1.66148 3.37855 1.92348 3.20404 2.21186 3.0856C2.50025 2.96715 2.80927 2.90712 3.12102 2.90898H7.56002" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.09 6.99497L13.005 2.90897M4.83496 13.803V11.638C4.83696 11.281 4.97896 10.938 5.22996 10.685L14.762 1.15297C14.8884 1.02507 15.039 0.923539 15.205 0.854244C15.371 0.784948 15.5491 0.749268 15.729 0.749268C15.9088 0.749268 16.0869 0.784948 16.2529 0.854244C16.4189 0.923539 16.5695 1.02507 16.696 1.15297L18.847 3.30397C18.9749 3.43045 19.0764 3.58104 19.1457 3.74702C19.215 3.91301 19.2507 4.0911 19.2507 4.27097C19.2507 4.45084 19.215 4.62892 19.1457 4.79491C19.0764 4.9609 18.9749 5.11149 18.847 5.23797L9.31496 14.77C9.0615 15.0217 8.71918 15.1636 8.36196 15.165H6.19696C6.01803 15.1652 5.8408 15.1302 5.67544 15.0618C5.51007 14.9935 5.35982 14.8932 5.2333 14.7666C5.10677 14.6401 5.00646 14.4899 4.9381 14.3245C4.86975 14.1591 4.8347 13.9819 4.83496 13.803Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="flex flex-col w-full justify-center px-7 mt-4">
            <div class="flex flex-row justify-between items-center font-semibold text-sm py-2 border-b-2">
                {{ $user->nik }}
                <span class="text-xs font-normal text-slate-400">(NIK)</span>
            </div>
            <div class="flex flex-row justify-between items-center font-semibold text-sm py-2 border-b-2">
                {{ $user->email }}
                <span class="text-xs font-normal text-slate-400">(Email)</span>
            </div>
            <a href="#" class="flex flex-row font-medium justify-center items-center text-sm py-2 border-2 border-[#0BB4A6] mt-6 rounded-lg hover:bg-[#0BB4A6] hover:text-white" onclick="openPassword()">
                Ubah kata sandi
            </a>
            <form method="POST" action="{{ route('logout') }}" onsubmit="resetPopupOnLogout()" class="w-full">
                @csrf
                <button type="submit" class="w-full flex flex-row font-medium justify-center text-white items-center text-sm py-2.5 bg-[#0BB4A6] rounded-lg hover:bg-[#268880] mt-2">
                    Logout
                </button>
            </form>
        </div>

        <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
                <h1 class="text-xl font-bold text-center text-[#0BB4A6] uppercase">
                    UBAH PROFILE
                </h1>

                <!-- Form di dalam modal -->
                <form class="mt-4 flex flex-col gap-2" action="{{ route('profile.ubah') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                        placeholder="Nama" required />

                    <input type="file" name="foto"
                        class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1" />

                    <!-- Tombol Submit dan Batal -->
                    <button type="submit"
                        class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold w-full text-center text-white">
                        Submit
                    </button>
                    <button type="button"
                        class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold w-full text-center text-[#0BB4A6]"
                        onclick="closeModal()">
                        Batal
                    </button>
                </form>
            </div>
        </div>

        <div id="myPassword" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
                <h1 class="text-xl font-bold text-center text-[#0BB4A6] uppercase">
                    UBAH PASSWORD
                </h1>

                <!-- Form di dalam modal -->
                <form class="mt-4 flex flex-col gap-2" action="{{ route('user.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Password saat ini -->
                    <div class="relative w-full">
                        <input type="password" name="current_password" id="current_password"
                            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Password saat ini" />
                    
                        <!-- Ikon Mata -->
                        <span onclick="togglePassword('current_password', 'eyeIconCurrent')" 
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                            <i id="eyeIconCurrent" class="fas fa-eye text-gray-300"></i>
                        </span>
                    </div>
                
                    <!-- Password Baru -->
                    <div class="relative w-full">
                        <input type="password" name="password" id="password"
                            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Password Baru" />
                    
                        <!-- Ikon Mata -->
                        <span onclick="togglePassword('password', 'eyeIconNew')" 
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                            <i id="eyeIconNew" class="fas fa-eye text-gray-300"></i>
                        </span>
                    </div>
                
                    <!-- Ulangi Password -->
                    <div class="relative w-full">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                            placeholder="Ulangi Password" />
                    
                        <!-- Ikon Mata -->
                        <span onclick="togglePassword('password_confirmation', 'eyeIconConfirm')" 
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                            <i id="eyeIconConfirm" class="fas fa-eye text-gray-300"></i>
                        </span>
                    </div>
                
                    <!-- Script untuk Toggle Password -->
                    <script>
                        // Fungsi untuk Toggle Password
                        function togglePassword(inputId, iconId) {
                            let input = document.getElementById(inputId);
                            let icon = document.getElementById(iconId);
                        
                            if (input.type === "password") {
                                input.type = "text"; // Menampilkan password
                                icon.classList.remove("fa-eye");
                                icon.classList.add("fa-eye-slash"); // Ganti ikon mata tertutup
                            } else {
                                input.type = "password"; // Menyembunyikan password
                                icon.classList.remove("fa-eye-slash");
                                icon.classList.add("fa-eye"); // Ganti ikon mata terbuka
                            }
                        }
                    </script>

                    <!-- Tampilkan pesan error jika ada -->
                    @if ($errors->any())
                    <div class="mt-2 text-red-600">
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <!-- Tombol Submit dan Batal -->
                    <button type="submit"
                        class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold w-full text-center text-white">
                        Submit
                    </button>
                    <button type="button"
                        class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold w-full text-center text-[#0BB4A6]"
                        onclick="closePassword()">
                        Batal
                    </button>
                </form>
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
    <script>
    // Fungsi untuk membuka modal
    function openModal() {
        document.getElementById("myModal").classList.remove("hidden");
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById("myModal").classList.add("hidden");
    }

    // Menutup modal jika klik di luar konten modal
    window.onclick = function(event) {
        const modal = document.getElementById("myModal");
        if (event.target === modal) {
            closeModal();
        }
    };

    // Modal PAssword
    function openPassword() {
        document.getElementById("myPassword").classList.remove("hidden");
    }

    // Fungsi untuk menutup Password
    function closePassword() {
        document.getElementById("myPassword").classList.add("hidden");
    }

    // Menutup Password jika klik di luar konten Password
    window.onclick = function(event) {
        const password = document.getElementById("myPassword");
        if (event.target === password) {
            closePassword();
        }
    };
    </script>


@endsection
