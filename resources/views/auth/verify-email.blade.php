<x-guest-layout>
    <div>
        <div class="mb-8">
            <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-warning-500 to-primary-600 shadow-lg">
                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <h2 class="font-serif text-3xl font-bold text-primary-900 dark:text-white">Verifikasi Email</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 rounded-xl border border-success-100 bg-success-50 p-3 text-sm font-medium text-success-700 dark:border-success-500/30 dark:bg-success-500/10 dark:text-success-500">
                Tautan verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="auth-btn">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full rounded-xl border-2 border-cream-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition-all duration-200 hover:border-accent-300 hover:bg-cream-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:border-slate-600 dark:hover:bg-slate-700">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
