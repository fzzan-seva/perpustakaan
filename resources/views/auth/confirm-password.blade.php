<x-guest-layout>
    <div>
        <div class="mb-8">
            <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-accent-600 shadow-lg">
                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h2 class="font-serif text-3xl font-bold text-primary-900 dark:text-white">Konfirmasi Password</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Ini adalah area aman. Silakan konfirmasi password Anda sebelum melanjutkan.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
            @csrf

            <div>
                <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="Masukkan password Anda"
                           class="auth-input pl-11">
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-btn">
                Konfirmasi
            </button>
        </form>
    </div>
</x-guest-layout>
