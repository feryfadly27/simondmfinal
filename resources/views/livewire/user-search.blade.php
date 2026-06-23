<section
    class="h-[730px] w-[350px] m-auto overflow-hidden bg-[#FF76CE] bg-cover bg-center rounded-3xl flex flex-col items-center p-7 container-snap overflow-y-auto scale-90">
    <div class="w-full flex flex-row justify-between items-center">
        <h1 class="text-xl text-start font-bold text-white mb-5">Selamat Datang, <br>Petugas</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <!-- Logout Button SVG Here -->
            </button>
        </form>
    </div>

    <h1 class="text-base font-bold text-white text-center">Data Pengguna</h1>

    <div class="w-full mt-4 flex flex-row justify-between">
        <div class="w-[70%] bg-white rounded-xl">
            <input type="text" wire:model="search" placeholder="Cari Pengguna"
                class="w-full rounded-xl border-none placeholder-slate-400 focus:outline-none focus:border-black focus:ring-black"
                required>
        </div>
    </div>

    <div class="grid grid-cols-2 mt-4 w-full gap-4">
        @foreach ($users as $user)
        <div class="bg-white w-full flex flex-col justify-between items-center rounded-xl p-3 gap-y-2">
            <h1 class="text-sm font-semibold text-black">{{ $user->nama_singkat }}</h1>

            <div class="h-[60px] w-[60px]">
                <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('assets/user.svg') }}"
                    alt="User Image" class="rounded-full h-full w-full object-cover">
            </div>
            <h1 class="text-sm text-center font-semibold text-black p-2">{{ $user->umur }} Tahun
                <br />{{ strtoupper($user->alamat_singkat) }}
            </h1>
            <a href="#" class="bg-[#FF76CE] py-1 px-3 rounded-full text-[0.7rem] text-white font-semibold">Detail</a>
        </div>
        @endforeach
    </div>
</section>