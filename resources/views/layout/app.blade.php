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
    @yield('content')
    {{-- @livewireScripts --}}

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
    </script>

    <script src="https://cdn.lordicon.com/lordicon.js"></script>

    @livewireScripts

</body>

</html>