<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Peminjaman'],
    ]" />

    <div class="space-y-6">
        <x-card title="Peminjaman Buku" :actions="[['label' => 'Tambah Peminjaman', 'href' => route('borrowings.create'), 'variant' => 'primary']]">
            <form action="{{ route('borrowings.index') }}" method="GET" class="mb-4">
                <div class="flex flex-col sm:flex-row gap-2">
                    <x-text-input type="text" name="search" :value="request('search')" placeholder="Cari peminjaman..." />
                    <x-primary-button type="submit" class="shrink-0">Cari</x-primary-button>
                </div>
            </form>

            {{-- Filter tabs --}}
            <div class="mb-4 flex flex-wrap gap-2">
                <a href="{{ route('borrowings.index') }}"
                   class="rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ !$filter ? 'bg-primary-900 text-accent-200 shadow-md' : 'bg-white ring-1 ring-cream-200 text-slate-600 hover:bg-accent-100/60 hover:text-primary-900 dark:bg-slate-800 dark:ring-slate-600 dark:text-slate-300' }}">
                    Semua
                </a>
                <a href="{{ route('borrowings.index', ['filter' => 'pending']) }}"
                   class="rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ $filter === 'pending' ? 'bg-primary-900 text-accent-200 shadow-md' : 'bg-white ring-1 ring-cream-200 text-slate-600 hover:bg-accent-100/60 hover:text-primary-900 dark:bg-slate-800 dark:ring-slate-600 dark:text-slate-300' }}">
                    Menunggu
                </a>
                <a href="{{ route('borrowings.index', ['filter' => 'active']) }}"
                   class="rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ $filter === 'active' ? 'bg-primary-900 text-accent-200 shadow-md' : 'bg-white ring-1 ring-cream-200 text-slate-600 hover:bg-accent-100/60 hover:text-primary-900 dark:bg-slate-800 dark:ring-slate-600 dark:text-slate-300' }}">
                    Aktif
                </a>
                <a href="{{ route('borrowings.index', ['filter' => 'returned']) }}"
                   class="rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ $filter === 'returned' ? 'bg-primary-900 text-accent-200 shadow-md' : 'bg-white ring-1 ring-cream-200 text-slate-600 hover:bg-accent-100/60 hover:text-primary-900 dark:bg-slate-800 dark:ring-slate-600 dark:text-slate-300' }}">
                    Dikembalikan
                </a>
                <a href="{{ route('borrowings.index', ['filter' => 'rejected']) }}"
                   class="rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ $filter === 'rejected' ? 'bg-primary-900 text-accent-200 shadow-md' : 'bg-white ring-1 ring-cream-200 text-slate-600 hover:bg-accent-100/60 hover:text-primary-900 dark:bg-slate-800 dark:ring-slate-600 dark:text-slate-300' }}">
                    Ditolak
                </a>
            </div>

            @if ($items->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-cream-100/80 dark:bg-slate-800 dark:text-slate-400">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Anggota</th>
                                <th class="px-4 py-3">Buku</th>
                                <th class="px-4 py-3">Tgl Pinjam</th>
                                <th class="px-4 py-3">Tgl Kembali</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200 dark:divide-slate-700">
                            @foreach ($items as $borrowing)
                                <tr class="bg-white transition-colors hover:bg-cream-50 dark:bg-slate-900 dark:hover:bg-slate-800/60">
                                    <td class="px-4 py-3">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                                    <td class="px-4 py-3">{{ $borrowing->member->name }}</td>
                                    <td class="px-4 py-3">{{ $borrowing->book->title }}</td>
                                    <td class="px-4 py-3">{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $borrowing->due_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if ($borrowing->status === 'pending')
                                            <x-badge variant="info">Menunggu</x-badge>
                                        @elseif ($borrowing->status === 'borrowed')
                                            <x-badge variant="warning">Dipinjam</x-badge>
                                        @elseif ($borrowing->status === 'returned')
                                            <x-badge variant="success">Dikembalikan</x-badge>
                                        @elseif ($borrowing->status === 'overdue')
                                            <x-badge variant="danger">Terlambat</x-badge>
                                        @elseif ($borrowing->status === 'rejected')
                                            <x-badge variant="danger">Ditolak</x-badge>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            @if ($borrowing->status === 'pending')
                                                <form action="{{ route('borrowings.confirm', $borrowing) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-success-50 px-3 py-1.5 text-xs font-medium text-success-700 transition-colors hover:bg-success-100 dark:bg-success-500/10 dark:text-success-400 dark:hover:bg-success-500/20">
                                                        Konfirmasi
                                                    </button>
                                                </form>
                                                <button type="button" x-data @click="$dispatch('open-modal', 'reject-{{ $borrowing->id }}')"
                                                        class="inline-flex items-center gap-1 rounded-lg bg-danger-50 px-3 py-1.5 text-xs font-medium text-danger-700 transition-colors hover:bg-danger-100 dark:bg-danger-500/10 dark:text-danger-400 dark:hover:bg-danger-500/20">
                                                    Tolak
                                                </button>

                                                {{-- Reject Modal --}}
                                                <x-modal name="reject-{{ $borrowing->id }}" title="Tolak Peminjaman">
                                                    <form action="{{ route('borrowings.reject', $borrowing) }}" method="POST" class="p-6">
                                                        @csrf
                                                        @method('PATCH')
                                                        <p class="mb-4 text-sm text-slate-600 dark:text-slate-400">
                                                            Yakin ingin menolak peminjaman buku <strong>{{ $borrowing->book->title }}</strong> oleh <strong>{{ $borrowing->member->name }}</strong>?
                                                        </p>
                                                        <div class="space-y-1">
                                                            <x-input-label value="Alasan Penolakan (opsional)" />
                                                            <textarea name="rejection_reason" rows="3" class="block w-full rounded-xl border-cream-200 bg-white px-3.5 py-2 text-sm text-slate-800 shadow-sm transition-all focus:border-accent-300 focus:outline-none focus:ring-2 focus:ring-accent-400/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200" placeholder="Berikan alasan penolakan..."></textarea>
                                                        </div>
                                                        <div class="mt-6 flex flex-wrap justify-end gap-3">
                                                            <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                                                            <x-danger-button type="submit">Tolak Peminjaman</x-danger-button>
                                                        </div>
                                                    </form>
                                                </x-modal>
                                            @else
                                                <a href="{{ route('borrowings.edit', $borrowing) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary-50 px-3 py-1.5 text-xs font-medium text-primary-700 transition-colors hover:bg-primary-100 dark:bg-primary-500/10 dark:text-primary-400 dark:hover:bg-primary-500/20">
                                                    Edit
                                                </a>
                                                @if ($borrowing->status === 'borrowed')
                                                    <a href="{{ route('returns.create', ['borrowing_id' => $borrowing->id]) }}" class="inline-flex items-center gap-1 rounded-lg bg-success-50 px-3 py-1.5 text-xs font-medium text-success-700 transition-colors hover:bg-success-100 dark:bg-success-500/10 dark:text-success-400 dark:hover:bg-success-500/20">
                                                        Kembalikan
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <x-pagination :paginator="$items" />
            @else
                <x-empty-state title="Belum ada data peminjaman" description="Mulai catat peminjaman buku baru." icon="arrow-left-start-on-rectangle" />
            @endif
        </x-card>
    </div>
</x-app-layout>
