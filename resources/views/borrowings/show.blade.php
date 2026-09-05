<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Peminjaman', 'href' => route('borrowings.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Peminjaman">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <x-input-label value="Anggota" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->member->name }}</p>
                </div>

                <div>
                    <x-input-label value="Buku" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->book->title }}</p>
                </div>

                <div>
                    <x-input-label value="Tanggal Pinjam" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->borrow_date->format('d/m/Y') }}</p>
                </div>

                <div>
                    <x-input-label value="Tanggal Kembali" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->due_date->format('d/m/Y') }}</p>
                </div>

                <div>
                    <x-input-label value="Tanggal Dikembalikan" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->return_date ? $borrowing->return_date->format('d/m/Y') : '-' }}</p>
                </div>

                <div>
                    <x-input-label value="Status" />
                    <div class="mt-1">
                        @if ($borrowing->status === 'pending')
                            <x-badge variant="info">Menunggu Konfirmasi</x-badge>
                        @elseif ($borrowing->status === 'borrowed')
                            <x-badge variant="warning">Dipinjam</x-badge>
                        @elseif ($borrowing->status === 'returned')
                            <x-badge variant="success">Dikembalikan</x-badge>
                        @elseif ($borrowing->status === 'overdue')
                            <x-badge variant="danger">Terlambat</x-badge>
                        @elseif ($borrowing->status === 'rejected')
                            <x-badge variant="danger">Ditolak</x-badge>
                        @endif
                    </div>
                </div>

                @if ($borrowing->status === 'pending' && $borrowing->requested_at)
                <div>
                    <x-input-label value="Diajukan Pada" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->requested_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif

                @if ($borrowing->status === 'rejected')
                <div>
                    <x-input-label value="Ditolak Oleh" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->rejectedBy?->name ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Ditolak Pada" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->rejected_at?->format('d/m/Y H:i') ?? '-' }}</p>
                </div>
                @if ($borrowing->rejection_reason)
                <div class="sm:col-span-2">
                    <x-input-label value="Alasan Penolakan" />
                    <p class="mt-1 text-sm text-danger-600">{{ $borrowing->rejection_reason }}</p>
                </div>
                @endif
                @endif

                @if ($borrowing->status === 'borrowed' && $borrowing->confirmed_at)
                <div>
                    <x-input-label value="Dikonfirmasi Oleh" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->confirmedBy?->name ?? '-' }}</p>
                </div>
                <div>
                    <x-input-label value="Dikonfirmasi Pada" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->confirmed_at->format('d/m/Y H:i') }}</p>
                </div>
                @endif

                <div class="sm:col-span-2">
                    <x-input-label value="Catatan" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $borrowing->notes ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                <a href="{{ route('borrowings.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
                <a href="{{ route('borrowings.edit', $borrowing) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary-50 px-4 py-2.5 text-sm font-medium text-primary-700 transition-colors hover:bg-primary-100 dark:bg-primary-500/10 dark:text-primary-400 dark:hover:bg-primary-500/20">
                    Edit
                </a>
                <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" data-confirm="Yakin ingin menghapus peminjaman ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-danger-50 px-4 py-2.5 text-sm font-medium text-danger-700 transition-colors hover:bg-danger-100 dark:bg-danger-500/10 dark:text-danger-400 dark:hover:bg-danger-500/20">
                        Hapus
                    </button>
                </form>
            </div>
        </x-card>
    </div>
</x-app-layout>
