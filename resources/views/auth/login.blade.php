<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang Kembali!</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan masuk ke akun Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3A3D40] rounded-xl bg-gray-50 dark:bg-[#2A2D30] text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#D2FF3A] focus:border-transparent outline-none transition" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3A3D40] rounded-xl bg-gray-50 dark:bg-[#2A2D30] text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#D2FF3A] focus:border-transparent outline-none transition" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-[#3A3D40] text-[#8C84FF] shadow-sm focus:ring-[#8C84FF] dark:bg-[#2A2D30]" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-[#8C84FF] hover:text-[#B4AEFF] transition" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full py-3 bg-[#D2FF3A] hover:bg-[#bce634] text-black font-bold rounded-xl shadow-[0_0_15px_rgba(210,255,58,0.3)] transition transform hover:-translate-y-0.5">
            Log in
        </button>

        <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-[#8C84FF] hover:text-[#B4AEFF] transition">Daftar sekarang</a>
        </div>
    </form>
</x-guest-layout>
