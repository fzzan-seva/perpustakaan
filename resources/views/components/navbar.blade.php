@php
    $user = auth()->user();
@endphp

<header data-navbar class="navbar-blur sticky top-0 z-30 flex h-16 items-center gap-3 border-b border-transparent px-4 sm:px-6 lg:px-8 transition-all duration-300">
    {{-- Mobile menu button --}}
    <button @click="sidebarOpen = !sidebarOpen"
            class="p-2 rounded-lg text-slate-500 hover:bg-cream-200/70 dark:text-slate-400 dark:hover:bg-slate-700 lg:hidden">
        <x-icon name="o-bars-3" class="h-5 w-5" />
    </button>

    {{-- Brand on mobile --}}
    <a href="{{ url('/') }}" class="flex items-center gap-2 text-primary-900 lg:hidden">
        <x-icon name="o-book-open" class="h-6 w-6 text-accent-500" />
        <span class="font-serif text-base font-bold tracking-tight">Perpustakaan</span>
    </a>

    {{-- Search --}}
    <form action="{{ auth()->user()->hasRole('siswa') ? route('catalog.index') : route('books.index') }}"
          method="GET"
          role="search"
          class="relative flex-1 max-w-full sm:max-w-md"
          x-data
          @keydown.slash.window.prevent="$refs.searchInput.focus()">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
            <x-icon name="o-magnifying-glass" class="h-4 w-4 text-accent-600/70" />
        </div>
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari buku, anggota, ISBN..."
               x-ref="searchInput"
               autocomplete="off"
               class="w-full rounded-xl border border-cream-200 bg-white/70 py-2 pl-10 pr-10 text-sm text-slate-800 placeholder-slate-400 shadow-sm transition-all focus:border-accent-300 focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent-400/30 focus:shadow-card dark:border-slate-600 dark:bg-slate-800/70 dark:text-white dark:placeholder-slate-400" />
        <kbd class="pointer-events-none absolute inset-y-0 right-3 hidden items-center rounded-md border border-cream-200 bg-cream-100 px-1.5 font-sans text-[10px] font-semibold text-slate-400 sm:inline-flex dark:border-slate-600 dark:bg-slate-700">/</kbd>
    </form>

    <div class="flex items-center gap-1.5">
        {{-- Dark Mode Toggle --}}
        <x-dark-mode-toggle />

        {{-- Notification --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="relative p-2 rounded-xl text-slate-500 hover:bg-cream-200/70 hover:text-primary-900 dark:text-slate-400 dark:hover:bg-slate-700 transition-colors">
                <x-icon name="o-bell" class="h-5 w-5" />
                <span class="absolute top-1.5 right-1.5 h-2 w-2 rounded-full bg-cta-500 ring-2 ring-white"></span>
            </button>

            <div x-show="open" @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-3 w-80 rounded-2xl border border-cream-200 bg-white shadow-card-hover ring-1 ring-primary-900/5 dark:border-slate-700 dark:bg-slate-800"
                 style="display: none;">
                <div class="border-b border-cream-200 px-4 py-3 dark:border-slate-700">
                    <h3 class="text-sm font-semibold text-primary-900 dark:text-white">Notifikasi</h3>
                </div>
                <div class="max-h-80 overflow-y-auto">
                    <div class="flex items-start gap-3 px-4 py-3 hover:bg-cream-50 dark:hover:bg-slate-700/50">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-danger-50 dark:bg-danger-500/20">
                            <x-icon name="o-exclamation-triangle" class="h-4 w-4 text-danger-600 dark:text-danger-400" />
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-300">Buku terlambat dikembalikan</p>
                            <p class="mt-0.5 text-xs text-slate-400">2 menit lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 px-4 py-3 hover:bg-cream-50 dark:hover:bg-slate-700/50">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-warning-50 dark:bg-warning-500/20">
                            <x-icon name="o-arrow-left-start-on-rectangle" class="h-4 w-4 text-warning-600 dark:text-warning-400" />
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-300">Peminjaman baru hari ini</p>
                            <p class="mt-0.5 text-xs text-slate-400">15 menit lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 px-4 py-3 hover:bg-cream-50 dark:hover:bg-slate-700/50">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-warning-50 dark:bg-warning-500/20">
                            <x-icon name="o-exclamation-circle" class="h-4 w-4 text-warning-600 dark:text-warning-400" />
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-300">Stok buku "Pemrograman" hampir habis</p>
                            <p class="mt-0.5 text-xs text-slate-400">1 jam lalu</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-cream-200 px-4 py-2.5 dark:border-slate-700">
                    <a href="#" class="text-xs font-semibold text-accent-600 hover:text-accent-700 dark:text-accent-400">
                        Lihat semua notifikasi
                    </a>
                </div>
            </div>
        </div>

        {{-- Profile Dropdown --}}
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="flex items-center gap-2 rounded-xl p-1.5 pr-2 text-sm font-medium text-slate-600 transition-colors hover:bg-cream-200/70 dark:text-slate-300 dark:hover:bg-slate-700">
                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-primary-800 to-primary-950 text-sm font-semibold text-accent-200 ring-2 ring-accent-300/40">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <span class="hidden text-sm font-medium text-primary-900 dark:text-slate-300 md:block">{{ $user->name }}</span>
                <x-icon name="o-chevron-down" class="hidden h-4 w-4 text-slate-400 md:block" />
            </button>

            <div x-show="open" @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-3 w-60 rounded-2xl border border-cream-200 bg-white shadow-card-hover ring-1 ring-primary-900/5 dark:border-slate-700 dark:bg-slate-800"
                 style="display: none;">
                <div class="border-b border-cream-200 px-4 py-3 dark:border-slate-700">
                    <p class="text-sm font-semibold text-primary-900 dark:text-white">{{ $user->name }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                    <span class="mt-1.5 inline-flex items-center rounded-full bg-accent-100 px-2 py-0.5 text-xs font-medium text-accent-800 dark:bg-accent-900/30 dark:text-accent-400">
                        {{ ucfirst($user->getFirstRoleName() ?? 'User') }}
                    </span>
                </div>
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-cream-50 dark:text-slate-300 dark:hover:bg-slate-700/50">
                        <x-icon name="o-user-circle" class="h-4 w-4" />
                        Profil Saya
                    </a>
                </div>
                <div class="border-t border-cream-200 py-1 dark:border-slate-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-2.5 px-4 py-2 text-sm text-danger-600 hover:bg-danger-50 dark:text-danger-400 dark:hover:bg-danger-500/10">
                            <x-icon name="o-arrow-right-on-rectangle" class="h-4 w-4" />
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>