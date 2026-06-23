<nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
      >
        <div
          class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
        >
          <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button"
            onclick="toggleNavbar('example-collapse-sidebar')"
          >
            <i class="fas fa-bars"></i>
          </button>

          <div class="flex flex-row gap-2">
            <img src="{{ asset('assets/simon-dm.png') }}" alt="" class="w-10 hidden lg:inline-block">
            <a class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin') }}">
              Simon DM
            </a>
          </div>

          <ul class="md:hidden items-center flex flex-wrap list-none">
            {{-- Profile Responsive --}}
            <li class="inline-block relative">
              <a
                  class="text-blueGray-500 block"
                  href="#pablo"
                  onclick="openDropdown(event,'user-responsive-dropdown')"
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
                class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                id="user-responsive-dropdown"
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
            </li>
          </ul>
          <div
            class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar"
          >
            <div
              class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200"
            >
              <div class="flex flex-wrap">
                <div class="w-6/12">
                  <a
                    class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                    href="#"
                  >
                    Simon DM
                  </a>
                </div>
                <div class="w-6/12 flex justify-end">
                  <button
                    type="button"
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    onclick="toggleNavbar('example-collapse-sidebar')"
                  >
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </div>
            <form class="mt-6 mb-4 md:hidden">
              <div class="mb-3 pt-0">
                <input
                  type="text"
                  placeholder="Search"
                  class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
                />
              </div>
            </form>

            <!-- Divider -->
            <hr class="my-4 md:min-w-full" />
            <!-- Heading -->
            <h6
              class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
            >
              Halaman Admin
            </h6>
            <!-- Navigation -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
              <li class="items-center">
                <a
                  href="{{ route('admin') }}"
                  class="text-xs uppercase py-3 font-bold block 
                  {{ request()->is('admin') ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-blueGray-700 hover:text-blueGray-500' }}"
                >
                  <i class="fas fa-tv mr-5 text-sm {{ request()->is('admin') ? '' : 'text-blueGray-300' }} h-2 w-2"></i>
                  Dashboard
                </a>
              </li>

              <li class="items-center">
                <a
                  href="{{ route('admin.data-pasien') }}"
                  class="text-xs uppercase py-3 font-bold block 
                  {{ request()->is('admin/data-pasien') ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-blueGray-700 hover:text-blueGray-500' }}"
                >
                  <i class="fas fa-users mr-5 text-sm {{ request()->is('admin/data-pasien') ? '' : 'text-blueGray-300' }} h-2 w-2"></i>
                  Data Pasien
                </a>
              </li>

              <li class="items-center">
                <a
                  href="{{route('admin.pengingat-user')}}"
                  class="text-xs uppercase py-3 font-bold block
                  {{ request()->is('admin/pengingat-user') ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-blueGray-700 hover:text-blueGray-500' }}"
                >
                  <i
                    class="fas fa-bell mr-5 text-sm {{ request()->is('admin/pengingat-user') ? '' : 'text-blueGray-300' }} h-2 w-2"
                  ></i>
                  Data Pengingat
                </a>
              </li>

              <li class="items-center">
                <a
                  href="{{route('admin.stok-obat')}}"
                  class="text-xs uppercase py-3 font-bold block 
                  {{ request()->is('admin/stok-obat') ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-blueGray-700 hover:text-blueGray-500' }}"
                >
                  <i class="fas fa-capsules mr-5 text-sm {{ request()->is('admin/stok-obat') ? '' : 'text-blueGray-300' }} h-2 w-2"></i>
                  Data Obat
                </a>
              </li>

              <li class="items-center">
                <a
                  href="{{route('admin.users')}}"
                  class="text-xs uppercase py-3 font-bold block 
                  {{ request()->is('admin/users') ? 'text-[#0BB4A6] hover:text-[#32aaa0]' : 'text-blueGray-700 hover:text-blueGray-500' }}"
                >
                  <i class="fas fa-user-check mr-5 text-sm {{ request()->is('admin/users') ? '' : 'text-blueGray-300' }} h-2 w-2"></i>
                  Data Verifikasi
                </a>
              </li>

            </ul>
      </nav>