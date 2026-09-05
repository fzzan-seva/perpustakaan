@php
    $currentRoute = request()->route()->getName() ?? '';

    $isActive = function (string $route) use ($currentRoute) {
        if ($route === $currentRoute) {
            return true;
        }
        $prefix = rtrim($route, '.index');
        return str_starts_with($currentRoute, $prefix . '.');
    };

    $pendingCount = \App\Models\Borrowing::where('status', 'pending')->count();

    $adminMenu = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'o-home'],
        [
            'label' => 'Manajemen Data',
            'items' => [
                ['label' => 'Buku', 'route' => 'books.index', 'icon' => 'o-book-open'],
                ['label' => 'Kategori', 'route' => 'categories.index', 'icon' => 'o-tag'],
                ['label' => 'Penulis', 'route' => 'authors.index', 'icon' => 'o-pencil'],
                ['label' => 'Penerbit', 'route' => 'publishers.index', 'icon' => 'o-building-office'],
                ['label' => 'Rak Buku', 'route' => 'racks.index', 'icon' => 'o-bars-3-bottom-left'],
            ],
        ],
        [
            'label' => 'Transaksi',
            'items' => [
                ['label' => 'Peminjaman', 'route' => 'borrowings.index', 'icon' => 'o-arrow-left-start-on-rectangle', 'badge' => $pendingCount],
                ['label' => 'Pengembalian', 'route' => 'returns.index', 'icon' => 'o-arrow-right-end-on-rectangle'],
            ],
        ],
        ['label' => 'Anggota', 'route' => 'members.index', 'icon' => 'o-users'],
        ['label' => 'Laporan', 'route' => 'reports.index', 'icon' => 'o-chart-bar'],
        ['label' => 'Activity Log', 'route' => 'activity-log.index', 'icon' => 'o-clock'],
    ];

    $petugasMenu = [
        ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'o-home'],
        [
            'label' => 'Manajemen Data',
            'items' => [
                ['label' => 'Buku', 'route' => 'books.index', 'icon' => 'o-book-open'],
                ['label' => 'Kategori', 'route' => 'categories.index', 'icon' => 'o-tag'],
                ['label' => 'Penulis', 'route' => 'authors.index', 'icon' => 'o-pencil'],
                ['label' => 'Penerbit', 'route' => 'publishers.index', 'icon' => 'o-building-office'],
                ['label' => 'Rak Buku', 'route' => 'racks.index', 'icon' => 'o-bars-3-bottom-left'],
            ],
        ],
        [
            'label' => 'Transaksi',
            'items' => [
                ['label' => 'Peminjaman', 'route' => 'borrowings.index', 'icon' => 'o-arrow-left-start-on-rectangle', 'badge' => $pendingCount],
                ['label' => 'Pengembalian', 'route' => 'returns.index', 'icon' => 'o-arrow-right-end-on-rectangle'],
            ],
        ],
        ['label' => 'Anggota', 'route' => 'members.index', 'icon' => 'o-users'],
        ['label' => 'Laporan', 'route' => 'reports.index', 'icon' => 'o-chart-bar'],
    ];

    $siswaMenu = [
        ['label' => 'Katalog Buku', 'route' => 'catalog.index', 'icon' => 'o-book-open'],
        ['label' => 'Riwayat Pinjam', 'route' => 'borrowings.history', 'icon' => 'o-clock'],
    ];

    $menu = match(true) {
        auth()->user()->hasRole('admin') => $adminMenu,
        auth()->user()->hasRole('petugas') => $petugasMenu,
        default => $siswaMenu,
    };
@endphp

{{-- Desktop Sidebar --}}
<aside class="fixed inset-y-0 left-0 z-50 flex flex-col border-r border-cream-200 bg-white transition-all duration-300 dark:border-slate-700 dark:bg-slate-800 lg:flex"
       x-bind:class="sidebarCollapsed ? 'w-[5.5rem]' : 'w-[17rem]'"
       x-cloak
>
    {{-- Logo --}}
    <div class="sidebar-header-deco relative flex h-20 items-center gap-3 px-4 overflow-hidden" x-bind:class="sidebarCollapsed ? 'justify-center' : ''">
        <div class="absolute inset-0 opacity-15">
            <svg class="w-full h-full" viewBox="0 0 200 80" preserveAspectRatio="xMidYMid slice">
                <rect x="10" y="10" width="8" height="60" rx="2" fill="white" opacity="0.4"/>
                <rect x="22" y="20" width="8" height="50" rx="2" fill="white" opacity="0.2"/>
                <rect x="34" y="5" width="8" height="65" rx="2" fill="white" opacity="0.35"/>
                <rect x="150" y="15" width="8" height="55" rx="2" fill="white" opacity="0.25"/>
                <rect x="162" y="8" width="8" height="62" rx="2" fill="white" opacity="0.3"/>
                <rect x="174" y="25" width="8" height="45" rx="2" fill="white" opacity="0.2"/>
            </svg>
        </div>
        <a href="{{ url('/') }}" class="relative z-10 flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-accent-300 to-accent-500 shadow-lg ring-1 ring-white/40">
                <x-icon name="o-book-open" class="h-6 w-6 text-primary-950" />
            </div>
            <span class="font-serif text-lg font-bold text-white drop-shadow-md transition-all duration-300 tracking-tight"
                  x-bind:class="sidebarCollapsed ? 'hidden' : ''">
                Perpustakaan
            </span>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        @foreach ($menu as $item)
            @if (isset($item['items']))
                {{-- Section with sub-items --}}
                <div class="pt-2">
                    <div class="sidebar-section-title" x-bind:class="sidebarCollapsed ? 'hidden' : ''">
                        {{ $item['label'] }}
                    </div>
                    @foreach ($item['items'] as $subItem)
                        <a href="{{ route($subItem['route']) }}"
                           class="sidebar-link {{ $isActive($subItem['route']) ? 'active' : '' }}"
                           x-bind:class="sidebarCollapsed ? 'justify-center px-2' : ''"
                           title="{{ $subItem['label'] }}">
                            <x-icon :name="$subItem['icon']" class="sidebar-link-icon" />
                            <span class="flex-1 transition-all duration-300 flex items-center gap-2" x-bind:class="sidebarCollapsed ? 'hidden' : ''">
                                {{ $subItem['label'] }}
                                @if (!empty($subItem['badge']) && $subItem['badge'] > 0)
                                    <span class="inline-flex items-center justify-center rounded-full bg-danger-500 px-1.5 py-0.5 text-[10px] font-bold text-white min-w-[18px]">{{ $subItem['badge'] }}</span>
                                @endif
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                {{-- Single item --}}
                <a href="{{ route($item['route']) }}"
                   class="sidebar-link {{ $isActive($item['route']) ? 'active' : '' }}"
                   x-bind:class="sidebarCollapsed ? 'justify-center px-2' : ''"
                   title="{{ $item['label'] }}">
                    <x-icon :name="$item['icon']" class="sidebar-link-icon" />
                    <span class="transition-all duration-300" x-bind:class="sidebarCollapsed ? 'hidden' : ''">
                        {{ $item['label'] }}
                    </span>
                </a>
            @endif
        @endforeach
    </nav>

    {{-- Collapse Toggle --}}
    <div class="border-t border-cream-200 p-3 dark:border-slate-700">
        <button @click="sidebarCollapsed = !sidebarCollapsed"
                class="sidebar-link w-full"
                x-bind:class="sidebarCollapsed ? 'justify-center px-2' : ''"
                title="Toggle sidebar">
            <x-icon name="o-chevron-double-left" class="sidebar-link-icon transition-transform duration-300"
                    x-bind:class="sidebarCollapsed ? 'rotate-180' : ''" />
            <span class="transition-all duration-300" x-bind:class="sidebarCollapsed ? 'hidden' : ''">
                Kecilkan
            </span>
        </button>
    </div>
</aside>

{{-- Mobile Sidebar --}}
<aside class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-cream-200 bg-white transition-transform duration-300 dark:border-slate-700 dark:bg-slate-800 lg:hidden"
       x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       x-cloak
>
    {{-- Logo --}}
    <div class="sidebar-header-deco relative flex h-20 items-center justify-between px-4 overflow-hidden">
        <div class="absolute inset-0 opacity-15">
            <svg class="w-full h-full" viewBox="0 0 200 80" preserveAspectRatio="xMidYMid slice">
                <rect x="10" y="10" width="8" height="60" rx="2" fill="white" opacity="0.4"/>
                <rect x="22" y="20" width="8" height="50" rx="2" fill="white" opacity="0.2"/>
                <rect x="34" y="5" width="8" height="65" rx="2" fill="white" opacity="0.35"/>
                <rect x="150" y="15" width="8" height="55" rx="2" fill="white" opacity="0.25"/>
                <rect x="162" y="8" width="8" height="62" rx="2" fill="white" opacity="0.3"/>
                <rect x="174" y="25" width="8" height="45" rx="2" fill="white" opacity="0.2"/>
            </svg>
        </div>
        <a href="{{ url('/') }}" class="relative z-10 flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-accent-300 to-accent-500 shadow-lg ring-1 ring-white/40">
                <x-icon name="o-book-open" class="h-6 w-6 text-primary-950" />
            </div>
            <span class="font-serif text-lg font-bold text-white drop-shadow-md">Perpustakaan</span>
        </a>
        <button @click="sidebarOpen = false" class="relative z-10 p-1.5 rounded-lg bg-white/10 text-white/80 hover:bg-white/20">
            <x-icon name="o-x-mark" class="h-5 w-5" />
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        @foreach ($menu as $item)
            @if (isset($item['items']))
                <div class="pt-2">
                    <div class="sidebar-section-title">{{ $item['label'] }}</div>
                    @foreach ($item['items'] as $subItem)
                        <a href="{{ route($subItem['route']) }}"
                           class="sidebar-link {{ $isActive($subItem['route']) ? 'active' : '' }}">
                            <x-icon :name="$subItem['icon']" class="sidebar-link-icon" />
                            <span class="flex-1 flex items-center gap-2">{{ $subItem['label'] }}
                                @if (!empty($subItem['badge']) && $subItem['badge'] > 0)
                                    <span class="inline-flex items-center justify-center rounded-full bg-danger-500 px-1.5 py-0.5 text-[10px] font-bold text-white min-w-[18px]">{{ $subItem['badge'] }}</span>
                                @endif
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <a href="{{ route($item['route']) }}"
                   class="sidebar-link {{ $isActive($item['route']) ? 'active' : '' }}">
                    <x-icon :name="$item['icon']" class="sidebar-link-icon" />
                    <span>{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>
</aside>
