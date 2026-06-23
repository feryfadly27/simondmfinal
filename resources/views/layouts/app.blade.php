<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="{{ asset('assets/img/apple-icon.png') }}"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <link
      rel="stylesheet"
      href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
    />

    <script src="https://kit.fontawesome.com/b5684de0c6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('assets/styles/tailwind.css') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Simon DM</title>
  </head>
  <body class="text-blueGray-700 antialiased bg-slate-50">
    <div id="root">
    {{-- Sidebar --}}
      @include('layouts.sidebar')
    {{-- Sidebar --}}

    {{-- Navbar --}}
      @include('layouts.navbar')
    {{-- Navbar --}}

      {{-- Content --}}
      <!-- Header -->
      @yield('content')
      {{-- Content --}}
        
          
          {{-- Footer --}}
          @include('layouts.footer')
          {{-- Footer --}}

    {{-- Script --}}
    @include('layouts.script')
    {{-- Script --}}
  </body>
</html>
