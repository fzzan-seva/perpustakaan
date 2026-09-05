<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Pengembalian'],
    ]" />

    <div class="space-y-6">
        <x-card title="Pengembalian Buku" :actions="[['label' => 'Tambah Pengembalian', 'href' => route('returns.create'), 'variant' => 'primary']]">
            <form action="{{ route('returns.index') }}" method="GET" class="mb-4">
                <div class="flex flex-col sm:flex-row gap-2">
                    <x-text-input type="text" name="search" :value="request('search')" placeholder="Cari pengembalian..." />
                    <x-primary-button type="submit" class="shrink-0">Cari</x-primary-button>
                </div>
            </form>

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
                                <th class="px-4 py-3">Kondisi</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200 dark:divide-slate-700">
                            @foreach ($items as $item)
                                <tr class="bg-white transition-colors hover:bg-cream-50 dark:bg-slate-900 dark:hover:bg-slate-800/60">
                                    <td class="px-4 py-3">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                                    <td class="px-4 py-3">{{ $item->borrowing->member->name }}</td>
                                    <td class="px-4 py-3">{{ $item->borrowing->book->title }}</td>
                                    <td class="px-4 py-3">{{ $item->borrowing->borrow_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $item->return_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">
                                        @if ($item->condition === 'good')
                                            <x-badge variant="success">Baik</x-badge>
                                        @elseif ($item->condition === 'damaged')
                                            <x-badge variant="warning">Rusak</x-badge>
                                        @elseif ($item->condition === 'lost')
                                            <x-badge variant="danger">Hilang</x-badge>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('returns.edit', $item) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary-50 px-3 py-1.5 text-xs font-medium text-primary-700 transition-colors hover:bg-primary-100 dark:bg-primary-500/10 dark:text-primary-400 dark:hover:bg-primary-500/20">
                                                Edit
                                            </a>
                                            <form action="{{ route('returns.destroy', $item) }}" method="POST" data-confirm="Yakin ingin menghapus data pengembalian ini?">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-danger-50 px-3 py-1.5 text-xs font-medium text-danger-700 transition-colors hover:bg-danger-100 dark:bg-danger-500/10 dark:text-danger-400 dark:hover:bg-danger-500/20">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <x-pagination :paginator="$items" />
            @else
                <x-empty-state title="Belum ada data pengembalian" description="Belum ada pengembalian buku yang tercatat." icon="arrow-right-end-on-rectangle" />
            @endif
        </x-card>
    </div>
</x-app-layout>
