<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('assets/logo.png') }}">

    <title>SIMON-DM</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quintessential&display=swap');

    @import url('https://fonts.googleapis.com/css2?family=Ranchers&family=Righteous&display=swap');

    * {
        font-family: "Poppins", sans-serif;
    }

    /* Hide scrollbar for Chrome, Safari, and Opera */
    .container-snap::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge, and Firefox */
    .container-snap {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
    </style>
    @vite('resources/css/app.css')
    {{-- @livewireStyles --}}

    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script src="https://kit.fontawesome.com/b5684de0c6.js" crossorigin="anonymous"></script>

</head>

<body class="w-[100wh] h-screen bg-slate-200 sm:w-full flex justify-center items-center">
    <section
    class="relative h-[730px] w-[350px] m-auto overflow-hidden bg-slate-100 bg-cover bg-center rounded-3xl flex flex-col items-center container-snap overflow-y-auto scale-90">

        <div class="sticky top-0 bg-[#0BB4A6] w-full px-7 py-[14px] flex flex-row items-center justify-between z-20 rounded-t-3xl">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-chevron-left text-lg"></i>                             
            </a>
            <div class="flex flex-col">
                <h1 class="text-base text-center font-bold text-black">@yield('title', '')</h1>
            </div>
            <a href="{{ route('pengingat-kontrol.index') }}">
                <i class="relative fas fa-bell text-2xl text-black hover:text-gray-600">
                    @if ($totalKontrol > 0)
                        <span class="flex justify-center items-center h-4 w-4 absolute -top-0.5 -right-1 rounded-full bg-red-500 text-[0.6rem] text-white font-semibold p-1.5">{{ $totalKontrol }}</span>
                    @endif
                </i>
            </a>
        </div>
    @yield('content')
    {{-- @livewireScripts --}}

    @php
        $currentRoute = Route::currentRouteName();
    @endphp
    <div class="sticky bottom-0 p-3 items-center justify-between z-20 w-full">
    
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
        document.addEventListener("DOMContentLoaded", function () {
            if (!localStorage.getItem("popupShown")) {
                document.getElementById("popupModal").style.display = "flex";
            }
        });
    
        function closePopup() {
            document.getElementById("popupModal").style.display = "none";
            localStorage.setItem("popupShown", "true");
        }
    
        // Reset popup saat logout (panggil ini di logout)
        function resetPopupOnLogout() {
            localStorage.removeItem("popupShown");
        }

        function handleFooterPosition() {
        const footer = document.getElementById('footer');
        const wrapper = document.getElementById('page-wrapper');

        // Total tinggi dari section utama
        const wrapperHeight = wrapper.scrollHeight;
        const windowHeight = window.innerHeight;

        if (wrapperHeight > windowHeight) {
            footer.classList.remove('absolute');
            footer.classList.add('sticky', 'bottom-0');
        } else {
            footer.classList.remove('sticky');
            footer.classList.add('absolute');
        }
    }

    // Jalankan saat load dan resize
    window.addEventListener('load', handleFooterPosition);
    window.addEventListener('resize', handleFooterPosition);
    </script>

    <script src="https://cdn.lordicon.com/lordicon.js"></script>

    @livewireScripts

</body>

</html>