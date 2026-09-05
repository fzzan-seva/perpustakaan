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
    <body class="h-full font-sans antialiased bg-cream-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100" x-data="{ sidebarOpen: false, sidebarCollapsed: false }"
          x-init="
              $watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', value));
              sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
          ">
        @auth
        <div class="min-h-full">
            {{-- Mobile sidebar overlay --}}
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-40 bg-slate-900/80 lg:hidden" @click="sidebarOpen = false"
                 style="display: none;">
            </div>

            {{-- Sidebar --}}
            <x-sidebar />

            {{-- Main content --}}
            <div class="lg:pl-[17rem] transition-all duration-300" x-bind:class="{ 'lg:pl-[5.5rem]': sidebarCollapsed }">
                {{-- Navbar --}}
                <x-navbar />

                {{-- Page Content --}}
                <main class="py-8">
                    @if(isset($header) && $header)
                        <div class="mb-6 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    @endif
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        @else
            {{ $slot }}
        @endauth

        {{-- Toast Notifications --}}
        <x-toast />

        {{-- Global Confirm Dialog --}}
        <x-global-confirm-dialog />
    </body>
</html>
