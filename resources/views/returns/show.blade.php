<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Pengembalian', 'href' => route('returns.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Pengembalian">
            <div class="space-y-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Anggota</p>
                        <p class="text-sm text-slate-800 dark:text-white">{{ $return->borrowing->member->name }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Buku</p>
                        <p class="text-sm text-slate-800 dark:text-white">{{ $return->borrowing->book->title }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Tanggal Pinjam</p>
                        <p class="text-sm text-slate-800 dark:text-white">{{ $return->borrowing->borrow_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Tanggal Kembali</p>
                        <p class="text-sm text-slate-800 dark:text-white">{{ $return->return_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kondisi</p>
                        <div>
                            @if ($return->condition === 'good')
                                <x-badge variant="success">Baik</x-badge>
                            @elseif ($return->condition === 'damaged')
                                <x-badge variant="warning">Rusak</x-badge>
                            @elseif ($return->condition === 'lost')
                                <x-badge variant="danger">Hilang</x-badge>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Catatan</p>
                        <p class="text-sm text-slate-800 dark:text-white">{{ $return->notes ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                <a href="{{ route('returns.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
                <a href="{{ route('returns.edit', $return) }}" class="inline-flex items-center gap-1.5 rounded-xl bg-primary-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-primary-600">
                    Edit
                </a>
                <form action="{{ route('returns.destroy', $return) }}" method="POST" data-confirm="Yakin ingin menghapus data pengembalian ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-xl bg-danger-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all hover:bg-danger-600">
                        Hapus
                    </button>
                </form>
            </div>
        </x-card>
    </div>
</x-app-layout>
