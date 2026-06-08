<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Daftar sebagai murid untuk mulai bereksperimen.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3A3D40] rounded-xl bg-gray-50 dark:bg-[#2A2D30] text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#D2FF3A] focus:border-transparent outline-none transition" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3A3D40] rounded-xl bg-gray-50 dark:bg-[#2A2D30] text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#D2FF3A] focus:border-transparent outline-none transition" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3A3D40] rounded-xl bg-gray-50 dark:bg-[#2A2D30] text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#D2FF3A] focus:border-transparent outline-none transition" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                   class="w-full px-4 py-2 border border-gray-300 dark:border-[#3A3D40] rounded-xl bg-gray-50 dark:bg-[#2A2D30] text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-[#D2FF3A] focus:border-transparent outline-none transition" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <button type="submit" class="w-full py-3 bg-[#D2FF3A] hover:bg-[#bce634] text-black font-bold rounded-xl shadow-[0_0_15px_rgba(210,255,58,0.3)] transition transform hover:-translate-y-0.5">
            Daftar Sekarang
        </button>

        <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="font-bold text-[#8C84FF] hover:text-[#B4AEFF] transition">Log in di sini</a>
        </div>
    </form>
</x-guest-layout>
