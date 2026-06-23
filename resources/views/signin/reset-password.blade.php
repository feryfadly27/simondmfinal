@extends('layout.app')
@section('content')
<section
    class="h-[100vh] w-[350px] m-auto overflow-hidden scale-90 bg-cover bg-center rounded-3xl flex flex-col bg-white p-5">
    <h1 class="text-3xl font-bold text-center text-[#0BB4A6] mt-10">Reset Password</h1>
    <p class="text-center mt-5 text-[0.8rem] text-gray-500">Masukkan password baru anda</p>

    <!-- Form untuk reset password -->
    <form class="mt-7 flex flex-col justify-between h-full" method="POST" action="{{ route('password.store') }}">
        @csrf

        <div class="flex flex-col gap-2">
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <input type="email" name="email"
                class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
                placeholder="Email" value="{{ old('email', $request->email) }}" required autofocus>

            <!-- Error Message Email -->
            @if ($errors->has('email'))
            <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
            @endif

            <!-- Password -->
            <div class="relative w-full">
                <input id="password" type="password" name="password"
                    class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1 pr-10"
                    placeholder="Kata Sandi Baru" required>
                
                <span onclick="togglePassword('password', 'eyeIcon1')"
                    class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                    <i id="eyeIcon1" class="fas fa-eye text-gray-400"></i>
                </span>
            </div>

            <!-- Error Message Password -->
            @if ($errors->has('password'))
            <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
            @endif

            <!-- Confirm Password -->
            <div class="relative w-full">
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1 pr-10"
                    placeholder="Ulangi Kata Sandi Baru" required>

                <span onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                    class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                    <i id="eyeIcon2" class="fas fa-eye text-gray-400"></i>
                </span>
            </div>

            <!-- Error Message Confirm Password -->
            @if ($errors->has('password_confirmation'))
            <span class="text-red-500 text-sm">{{ $errors->first('password_confirmation') }}</span>
            @endif
        
        </div>


        <!-- Submit Button -->
        <button type="submit"
            class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-5 w-full text-center text-white">Submit</button>
    </form>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<script>
    function togglePassword(inputId, iconId) {
        let input = document.getElementById(inputId);
        let icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection