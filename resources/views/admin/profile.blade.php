@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <div class="flex flex-wrap">
            <div class="w-full mb-4 px-4">
                <div class="relative flex flex-col min-w-0 px-2 pt-2 pb-4 break-words w-full mb-6 shadow-lg rounded-2xl bg-white">
                  <a href="#" onclick="openModal()" class="absolute right-5 top-5 text-[#0BB4A6] text-xs flex flex-row items-center justify-center gap-2 pr-1.5 pl-2 py-1 bg-white hover:bg-slate-100 font-semibold rounded-lg">
                    <i class="fas fa-edit text-[#0BB4A6] text-base"></i>
                  </a>
                  <img src="{{ asset('assets/bg-vector.jpg') }}" alt="bg-vector" class="w-full rounded-xl object-cover h-36">
                  <div class="-mt-16 ml-5 flex flex-col lg:flex-row gap-3 lg:gap-20">
                      <div class="flex flex-col">
                          <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/user.svg') }}" alt="User Profile" class="rounded-full h-32 w-32 object-cover bg-white p-2">
                          <h3 class="text-2xl font-semibold leading-normal mt-2 text-blueGray-700 flex flex-row items-center">
                            {{ $user->name }}&nbsp;
                            <a href="#" onclick="openPassword()" class="text-white text-xs flex flex-row items-center justify-center gap-2 px-2 py-1 bg-red-500 hover:bg-red-600 font-semibold rounded-lg">
                              <i class="fas fa-unlock text-white text-sm"></i>
                              Ubah Password
                            </a>
                          </h3>
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

                      <div class="justify-end flex flex-col w-full lg:w-1/2 gap-3 pr-5">
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


                      </div>
                  </div>
                </div>
            </div>
        </div>

        <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
          <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
              <h1 class="text-xl font-bold text-center text-[#0BB4A6] uppercase">
                  UBAH PROFILE
              </h1>
  
              <!-- Form di dalam modal -->
              <form class="mt-4 flex flex-col gap-2" action="{{ route('admin.profile.ubah') }}" method="POST"
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
            <h1 class="text-xl font-bold text-center text-gray-400 uppercase">
                UBAH PASSWORD
            </h1>

            <!-- Form di dalam modal -->
            <form class="mt-4 flex flex-col gap-2" action="{{ route('password.update') }}" method="POST">
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
                    class="bg-red-500 hover:bg-red-600 px-5 py-2 rounded-md font-bold w-full text-center text-white">
                    Submit
                </button>
                <button type="button"
                    class="bg-white px-5 py-2 border-2 border-gray-400 hover:text-white rounded-md font-bold w-full text-center text-gray-400 hover:bg-gray-400"
                    onclick="closePassword()">
                    Batal
                </button>
            </form>
        </div>
      </div>

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