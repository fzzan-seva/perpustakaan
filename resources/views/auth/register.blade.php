<x-guest-layout>
    <div>
        <div class="mb-8">
            <h2 class="font-serif text-3xl font-bold text-primary-900 dark:text-white">Buat Akun</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Daftar untuk mulai meminjam buku</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                           placeholder="Nama lengkap Anda"
                           class="auth-input pl-11">
                </div>
                @error('name')
                    <p class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">Email</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                           placeholder="nama@email.com"
                           class="auth-input pl-11">
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           placeholder="Buat password baru"
                           class="auth-input pl-11">
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">Konfirmasi Password</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           placeholder="Ulangi password"
                           class="auth-input pl-11">
                </div>
                @error('password_confirmation')
                    <p class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-btn">
                Daftar Akun
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
