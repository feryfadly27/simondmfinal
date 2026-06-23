<x-guest-layout>
    <section class="h-[100vh] w-[350px] m-auto overflow-hidden bg-cover bg-center rounded-3xl flex flex-col bg-white p-5 shadow-lg">
        <h1 class="text-3xl font-bold text-center text-[#FF76CE] mt-10">Reset Password</h1>
        <p class="text-center mt-5 text-[0.9rem] text-gray-500">Masukkan password baru Anda</p>

        <form method="POST" action="{{ route('password.store') }}" class="mt-7 flex flex-col justify-between h-full gap-2">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="flex flex-col gap-2">
                <x-input-label for="email" :value="__('Email')" class="text-sm text-gray-600" />
                <x-text-input id="email" class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#FF76CE] focus:ring-[#FF76CE] block w-full rounded-md sm:text-sm focus:ring-1"
                              type="email"
                              name="email"
                              :value="old('email', $request->email)"
                              required
                              autofocus
                              autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-2">
                <x-input-label for="password" :value="__('Password')" class="text-sm text-gray-600" />
                <x-text-input id="password" class="mt-1 px-3 py-3 bg-white border border-slate-300 shadow-sm placeholder-slate-400 focus:outline-none focus:border-[#FF76CE] focus:ring-[#FF76CE] block w-full rounded-md sm:text-sm focus:ring-1"
                              type="password"
                              name="password"
                              required
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="flex flex-col gap-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm text-gray-600" />
                <x-text-input id="password_confirmation" class="mt-1 px-3 py-3 bg-white border border-slate-300 shadow-sm placeholder-slate-400 focus:outline-none focus:border-[#FF76CE] focus:ring-[#FF76CE] block w-full rounded-md sm:text-sm focus:ring-1"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center mt-5">
                <x-primary-button class="bg-[#FF76CE] hover:bg-[#e066ba] px-5 py-2 rounded-md font-bold w-full text-white text-center">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-guest-layout>
