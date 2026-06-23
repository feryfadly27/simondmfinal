<div class="relative md:ml-64 bg-blueGray-50">
  <nav
    class="absolute lg:top-0 left-0 w-full z-0 lg:z-10 md:flex-row md:flex-nowrap md:justify-start items-center p-4"
  >
    <div
      class="w-full mx-auto items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4"
    >

      <div class="hidden lg:flex items-center gap-[18rem]">

        <a
          class="text-white text-sm uppercase font-semibold"
          href="#">
          @yield('title', 'Dashboard')
        </a>
        
        <div class="px-3 py-1 bg-white rounded-lg">
          <img src="https://poltekkestasikmalaya.ac.id/wp-content/uploads/2025/01/cropped-logo-poltek-blu-1.png" alt="" class="h-10">
        </div>
      </div>

      <form method="GET"
        {{-- action="{{ 
          request()->is('admin/data-pasien') 
              ? route('admin.data-pasien') 
              : (request()->is('admin/stok-obat') 
                  ? route('admin.stok-obat') 
                  : (request()->is('admin/users') 
                      ? route('admin.users') 
                      : ''))
        }}" --}}
        class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
      >
        <div class="relative flex w-full flex-wrap items-stretch">
          <span
            class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
            ><i class="fas fa-search"></i
          ></span>
          <input
            type="text" name="search" id="search" value="{{ request('search') }}"
            placeholder="Search here..."
            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
          />
        </div>
      </form>
      
      {{-- Profile No Responsive --}}
      <ul
        class="flex-col md:flex-row list-none items-center hidden md:flex"
      >

      <a
      class="text-blueGray-500 block"
          href="#pablo"
          onclick="openDropdown(event,'user-dropdown')"
        >
          <div class="items-center flex">
            <span
              class="w-12 h-12 overflow-hidden text-sm text-gray-600 bg-blueGray-200 inline-flex items-center justify-center rounded-full"
              >
              @if ($authUser && $authUser->foto)
              <img src="{{ asset('storage/' . $authUser->foto) }}" alt="Foto Profil"
                  class="w-full rounded-full align-middle border-none shadow-lg object-cover">
              @else
              <i class="fas fa-user-circle text-[3.1rem]"></i>
              @endif
            </span>
          </div>
        </a>
        <div
          class="hidden bg-white text-base z-[9999] float-left py-2 list-none text-left rounded shadow-lg min-w-48"
          id="user-dropdown"
        >
        
          <a href="{{route('admin.profile')}}" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">My Profile</a>
          <div class="h-0 my-2 border border-solid border-blueGray-100"></div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700 text-start">
              Logout
            </button>
          </form>  

        </div>
      </ul>
      {{-- Profile No Responsive --}}

    </div>
  </nav>

  <div class="relative bg-[#0BB4A6] md:pt-32 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
      <div>
        <!-- Card stats -->
        <div class="flex flex-wrap">
          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                  <div
                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                  >
                    <h5
                      class="text-blueGray-400 uppercase font-bold text-xs"
                    >
                      Data Pasien
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ $totalPasien }}
                    </span>
                  </div>
                  <div class="relative w-auto pl-4 flex-initial">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500 hover:bg-red-600"
                    >
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
                <a href="{{ route('admin.data-pasien') }}" class="text-sm text-blueGray-400 mt-4 flex justify-start items-center">
                  <span class="whitespace-nowrap hover:text-gray-500">
                    More Info <i class="ml-1 fas fa-chevron-circle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                  <div
                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                  >
                    <h5
                      class="text-blueGray-400 uppercase font-bold text-xs"
                    >
                      Data Pengingat
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ $totalPengingat }}
                    </span>
                  </div>
                  <div class="relative w-auto pl-4 flex-initial">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500 hover:bg-orange-600"
                    >
                      <i class="fas fa-bell"></i>
                    </div>
                  </div>
                </div>
                <a href="#" class="text-sm text-blueGray-400 mt-4 flex justify-start items-center">
                  <span class="whitespace-nowrap hover:text-gray-500">
                    More Info <i class="ml-1 fas fa-chevron-circle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                  <div
                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                  >
                    <h5
                      class="text-blueGray-400 uppercase font-bold text-xs"
                    >
                      Data Obat
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ $totalObat }}
                    </span>
                  </div>
                  <div class="relative w-auto pl-4 flex-initial">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500 hover:bg-pink-600"
                    >
                      <i class="fas fa-capsules"></i>
                    </div>
                  </div>
                </div>
                <a href="{{route('admin.stok-obat')}}" class="text-sm text-blueGray-400 mt-4 flex justify-start items-center">
                  <span class="whitespace-nowrap hover:text-gray-500">
                    More Info <i class="ml-1 fas fa-chevron-circle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
            <div
              class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
            >
              <div class="flex-auto p-4">
                <div class="flex flex-wrap">
                  <div
                    class="relative w-full pr-4 max-w-full flex-grow flex-1"
                  >
                    <h5
                      class="text-blueGray-400 uppercase font-bold text-xs"
                    >
                      Data Verifikasi
                    </h5>
                    <span class="font-semibold text-xl text-blueGray-700">
                      {{ $totalVerifikasi }}
                    </span>
                  </div>
                  <div class="relative w-auto pl-4 flex-initial">
                    <div
                      class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full  bg-blue-400 hover:bg-blue-500"
                    >
                      <i class="fas fa-user-check"></i>
                    </div>
                  </div>
                </div>
                <a href="{{route('admin.users')}}" class="text-sm text-blueGray-400 mt-4 flex justify-start items-center">
                  <span class="whitespace-nowrap hover:text-gray-500">
                    More Info <i class="ml-1 fas fa-chevron-circle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>