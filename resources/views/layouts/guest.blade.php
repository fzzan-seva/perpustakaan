<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Perpustakaan Sekolah') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700,800,900|plus-jakarta-sans:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        <script>
            (function () {
                var theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            })();
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full bg-cream-50 font-sans antialiased dark:bg-slate-950">
        <div class="flex min-h-full">
            {{-- Left Panel: Gradient Branding --}}
            <div class="auth-gradient relative hidden flex-col items-center justify-center p-12 lg:flex lg:w-1/2">
                {{-- Decorative circles --}}
                <div class="absolute top-10 left-10 h-64 w-64 rounded-full bg-white/10 animate-float"></div>
                <div class="absolute bottom-20 right-10 h-48 w-48 rounded-full bg-white/5 animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute top-1/3 right-20 h-32 w-32 rounded-full bg-white/10 animate-float" style="animation-delay: 4s;"></div>

                {{-- Book Icon Pattern --}}
                <div class="relative z-10 text-center">
                    <div class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-3xl bg-white/20 shadow-2xl backdrop-blur-sm">
                        <svg class="h-14 w-14 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h1 class="font-serif text-4xl font-bold text-white drop-shadow-lg">
                        Perpustakaan<br>Sekolah
                    </h1>
                    <p class="mt-4 max-w-sm text-lg text-white/80">
                        Sistem Informasi Manajemen Perpustakaan Digital yang Modern dan Terintegrasi
                    </p>

                    {{-- Feature list --}}
                    <div class="mt-10 space-y-3 text-left">
                        <div class="flex items-center gap-3 text-white/90">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/20">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Manajemen Katalog Buku Digital</span>
                        </div>
                        <div class="flex items-center gap-3 text-white/90">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/20">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Sistem Peminjaman & Pengembalian</span>
                        </div>
                        <div class="flex items-center gap-3 text-white/90">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/20">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Laporan & Statistik Lengkap</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Panel: Form --}}
            <div class="flex w-full flex-col items-center justify-center px-6 py-12 lg:w-1/2">
                {{-- Mobile Logo --}}
                <div class="mb-8 flex items-center gap-3 lg:hidden">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-accent-600 shadow-lg">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-slate-800 dark:text-white">Perpustakaan</span>
                </div>

                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
