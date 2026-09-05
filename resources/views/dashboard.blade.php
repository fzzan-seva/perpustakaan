<x-app-layout>
    <x-breadcrumb :items="[['label' => 'Dashboard']]" />

    <div class="space-y-6">
        <div class="relative overflow-hidden rounded-3xl bg-primary-950 p-8 shadow-card-hover sm:p-10" data-reveal>
            <div class="pointer-events-none absolute inset-0 opacity-[0.07]">
                <svg class="w-full h-full" viewBox="0 0 400 120" preserveAspectRatio="xMidYMid slice">
                    <rect x="20" y="15" width="10" height="90" rx="2" fill="white"/>
                    <rect x="35" y="25" width="10" height="80" rx="2" fill="white" opacity="0.7"/>
                    <rect x="50" y="10" width="10" height="95" rx="2" fill="white" opacity="0.5"/>
                    <rect x="65" y="30" width="10" height="75" rx="2" fill="white" opacity="0.8"/>
                    <rect x="320" y="20" width="10" height="85" rx="2" fill="white" opacity="0.6"/>
                    <rect x="335" y="12" width="10" height="93" rx="2" fill="white" opacity="0.4"/>
                    <rect x="350" y="28" width="10" height="77" rx="2" fill="white" opacity="0.7"/>
                    <rect x="365" y="18" width="10" height="87" rx="2" fill="white" opacity="0.5"/>
                </svg>
            </div>
            <div class="pointer-events-none absolute -top-20 right-10 h-52 w-52 rounded-full bg-accent-500/20 blur-3xl"></div>
            <div class="relative z-10 flex flex-col items-start gap-5 sm:flex-row sm:items-center sm:gap-6">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-accent-300 to-accent-500 shadow-lg shadow-accent-500/30 ring-1 ring-white/30">
                    <x-icon name="o-book-open" class="h-8 w-8 text-primary-950" />
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-accent-300">{{ now()->format('l, d F Y') }}</p>
                    <h1 class="mt-1 font-serif text-2xl font-bold text-white sm:text-3xl">Halo, {{ auth()->user()->name }}</h1>
                    <p class="mt-1.5 text-sm text-white/70">Selamat datang kembali di Sistem Informasi Manajemen Perpustakaan Sekolah</p>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <x-stat-card title="Total Buku" value="{{ $totalBooks }}" icon="o-book-open" color="primary" route="books.index" data-reveal style="transition-delay:0ms" />
            <x-stat-card title="Total Anggota" value="{{ $totalMembers }}" icon="o-users" color="success" route="members.index" data-reveal style="transition-delay:80ms" />
            <x-stat-card title="Sedang Dipinjam" value="{{ $activeBorrowings }}" icon="o-arrow-left-start-on-rectangle" color="warning" route="borrowings.index" data-reveal style="transition-delay:160ms" />
            <x-stat-card title="Terlambat" value="{{ $overdueBorrowings }}" icon="o-exclamation-triangle" color="danger" route="borrowings.index" data-reveal style="transition-delay:240ms" />
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            {{-- Recent Activity --}}
            <x-card title="Aktivitas Terbaru">
                <div class="space-y-4">
                    @forelse ($recentActivities as $activity)
                        @php
                            $iconMap = ['create' => 'o-plus-circle', 'update' => 'o-pencil', 'delete' => 'o-trash', 'borrow' => 'o-arrow-left-start-on-rectangle', 'return' => 'o-arrow-right-end-on-rectangle'];
                            $colorMap = ['create' => 'text-success-500', 'update' => 'text-slate-500', 'delete' => 'text-danger-500', 'borrow' => 'text-primary-500', 'return' => 'text-warning-500'];
                            $actIcon = $iconMap[$activity->action] ?? 'o-clock';
                            $actColor = $colorMap[$activity->action] ?? 'text-slate-500';
                        @endphp
                        <div class="flex items-start gap-3">
                            <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-accent-100/70 ring-1 ring-accent-200/60">
                                <x-icon :name="$actIcon" class="h-4 w-4 {{ $actColor }}" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-slate-600">
                                    <span class="font-medium text-slate-800">{{ $activity->user->name ?? 'Sistem' }}</span>
                                    {{ $activity->description }}
                                </p>
                                <p class="text-xs text-slate-400">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Belum ada aktivitas.</p>
                    @endforelse
                </div>
            </x-card>

            {{-- Popular Books --}}
            <x-card title="Buku Terpopuler">
                <div class="space-y-3">
                    @forelse ($popularBooks as $book)
                        <div class="flex items-center justify-between rounded-xl p-3 transition-colors hover:bg-cream-100/80">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-50">
                                    <x-icon name="o-book-open" class="h-5 w-5 text-primary-500" />
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-slate-800 truncate">{{ $book->title }}</p>
                                    <p class="text-xs text-slate-500">{{ $book->author->name ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="shrink-0 text-right">
                                <p class="text-sm font-semibold text-primary-600">{{ $book->borrowings_count }}</p>
                                <p class="text-xs text-slate-400">kali dipinjam</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">Belum ada data buku populer.</p>
                    @endforelse
                </div>
            </x-card>
        </div>

        {{-- Quick Actions --}}
        <x-card title="Quick Actions" data-reveal>
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                <a href="{{ route('books.index') }}" class="group flex flex-col items-center gap-2.5 rounded-2xl border border-cream-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-accent-300 hover:shadow-card-hover">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary-50 text-primary-700 transition-colors duration-300 group-hover:bg-primary-900 group-hover:text-accent-200">
                        <x-icon name="o-plus" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-semibold text-slate-700 group-hover:text-primary-900">Tambah Buku</span>
                </a>
                <a href="{{ route('borrowings.index') }}" class="group flex flex-col items-center gap-2.5 rounded-2xl border border-cream-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-success-200 hover:shadow-card-hover">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-success-50 text-success-600 transition-colors duration-300 group-hover:bg-success-600 group-hover:text-white">
                        <x-icon name="o-arrow-left-start-on-rectangle" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-semibold text-slate-700 group-hover:text-primary-900">Pinjam Buku</span>
                </a>
                <a href="{{ route('returns.index') }}" class="group flex flex-col items-center gap-2.5 rounded-2xl border border-cream-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-warning-200 hover:shadow-card-hover">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50 text-warning-600 transition-colors duration-300 group-hover:bg-warning-600 group-hover:text-white">
                        <x-icon name="o-arrow-right-end-on-rectangle" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-semibold text-slate-700 group-hover:text-primary-900">Kembalikan</span>
                </a>
                <a href="{{ route('reports.index') }}" class="group flex flex-col items-center gap-2.5 rounded-2xl border border-cream-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-accent-300 hover:shadow-card-hover">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-50 text-accent-600 transition-colors duration-300 group-hover:bg-accent-400 group-hover:text-primary-950">
                        <x-icon name="o-chart-bar" class="h-5 w-5" />
                    </div>
                    <span class="text-sm font-semibold text-slate-700 group-hover:text-primary-900">Lihat Laporan</span>
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
