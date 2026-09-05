<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Laporan'],
    ]" />

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Laporan Perpustakaan</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ringkasan data dan statistik perpustakaan</p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-cream-200 bg-white p-5 shadow-card dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary-50 dark:bg-primary-500/10">
                        <x-icon name="o-book-open" class="h-6 w-6 text-primary-500" />
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Total Buku</p>
                        <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalBooks }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-cream-200 bg-white p-5 shadow-card dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-accent-50 dark:bg-accent-500/10">
                        <x-icon name="o-users" class="h-6 w-6 text-accent-500" />
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Total Anggota</p>
                        <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $totalMembers }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-cream-200 bg-white p-5 shadow-card dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-warning-50 dark:bg-warning-500/10">
                        <x-icon name="o-arrow-left-start-on-rectangle" class="h-6 w-6 text-warning-500" />
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Dipinjam</p>
                        <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $activeBorrowings }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-cream-200 bg-white p-5 shadow-card dark:border-slate-700 dark:bg-slate-800">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-danger-50 dark:bg-danger-500/10">
                        <x-icon name="o-exclamation-triangle" class="h-6 w-6 text-danger-500" />
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Terlambat</p>
                        <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $overdueBorrowings }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <x-card title="Buku Populer (Top 10)">
                @if ($popularBooks->isEmpty())
                    <x-empty-state title="Belum ada data" description="Belum ada peminjaman buku." icon="o-book-open" />
                @else
                    <div class="space-y-3">
                        @foreach ($popularBooks as $book)
                            <div class="flex items-center justify-between rounded-xl bg-cream-100/70 px-4 py-3 dark:bg-slate-700/50">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary-100 text-xs font-bold text-primary-700 dark:bg-primary-500/20 dark:text-primary-400">
                                        {{ $loop->iteration }}
                                    </span>
                                    <div>
                                        <p class="text-sm font-medium text-slate-800 dark:text-white">{{ $book->title }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $book->author->name }}</p>
                                    </div>
                                </div>
                                <x-badge variant="primary">{{ $book->borrowings_count }}x dipinjam</x-badge>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-card>

            <x-card title="Buku per Kategori">
                @if ($booksByCategory->isEmpty())
                    <x-empty-state title="Belum ada data" description="Belum ada kategori buku." icon="o-tag" />
                @else
                    <div class="space-y-3">
                        @foreach ($booksByCategory as $category)
                            <div class="flex items-center justify-between rounded-xl bg-cream-100/70 px-4 py-3 dark:bg-slate-700/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-accent-100 dark:bg-accent-500/20">
                                        <x-icon name="o-tag" class="h-4 w-4 text-accent-600 dark:text-accent-400" />
                                    </div>
                                    <p class="text-sm font-medium text-slate-800 dark:text-white">{{ $category->name }}</p>
                                </div>
                                <x-badge variant="info">{{ $category->books_count }} buku</x-badge>
                            </div>
                        @endforeach
                    </div>
                @endif
            </x-card>
        </div>

        <x-card title="Peminjaman Bulanan (6 Bulan Terakhir)">
            @if ($monthlyBorrowings->isEmpty())
                <x-empty-state title="Belum ada data" description="Belum ada riwayat peminjaman." icon="o-chart-bar" />
            @else
                <div class="flex items-end gap-3 overflow-x-auto pb-2">
                    @foreach ($monthlyBorrowings as $month)
                        @php
                            $maxCount = $monthlyBorrowings->max('count') ?: 1;
                            $height = max(40, ($month->count / $maxCount) * 160);
                        @endphp
                        <div class="flex min-w-[60px] flex-col items-center gap-2">
                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-200">{{ $month->count }}</span>
                            <div class="w-full rounded-t-lg bg-primary-500 transition-all dark:bg-primary-400" style="height: {{ $height }}px"></div>
                            <span class="text-xs text-slate-500 dark:text-slate-400">{{ \Carbon\Carbon::parse($month->month)->format('M Y') }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </x-card>

        <x-card title="Peminjaman Terbaru">
            @if ($recentBorrowings->isEmpty())
                <x-empty-state title="Belum ada data" description="Belum ada peminjaman tercatat." icon="o-clock" />
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-cream-100/80 dark:bg-slate-800 dark:text-slate-400">
                            <tr>
                                <th class="px-4 py-3">Anggota</th>
                                <th class="px-4 py-3">Buku</th>
                                <th class="px-4 py-3">Tgl Pinjam</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200 dark:divide-slate-700">
                            @foreach ($recentBorrowings as $borrowing)
                                <tr class="bg-white transition-colors hover:bg-cream-50 dark:bg-slate-900 dark:hover:bg-slate-800/60">
                                    <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $borrowing->member->name }}</td>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $borrowing->book->title }}</td>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if ($borrowing->status === 'borrowed')
                                            <x-badge variant="warning">Dipinjam</x-badge>
                                        @elseif ($borrowing->status === 'returned')
                                            <x-badge variant="success">Dikembalikan</x-badge>
                                        @elseif ($borrowing->status === 'overdue')
                                            <x-badge variant="danger">Terlambat</x-badge>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
