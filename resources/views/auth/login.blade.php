<x-guest-layout>
    <div>
        <div class="mb-8">
            <h2 class="font-serif text-3xl font-bold text-primary-900 dark:text-white">Selamat Datang</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Masuk ke akun perpustakaan Anda</p>
        </div>

        {{-- Session Status --}}
        @if(session('status'))
            <div class="mb-4 rounded-xl border border-success-100 bg-success-50 p-3 text-sm font-medium text-success-700 dark:border-success-500/30 dark:bg-success-500/10 dark:text-success-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">Email</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
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
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="Masukkan password"
                           class="auth-input pl-11">
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center gap-2">
                    <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-primary-500 focus:ring-primary-500 dark:border-slate-600 dark:bg-slate-700">
                    <span class="text-sm text-slate-600 dark:text-slate-400">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">
                        Lupa password?
                    </a>
                @endif
            </div>

            <button type="submit" class="auth-btn">
                Masuk
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-accent-600 hover:text-accent-500 dark:text-accent-400">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
