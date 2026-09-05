<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Katalog Buku', 'href' => route('catalog.index')],
        ['label' => 'Riwayat Pinjam'],
    ]" />

    <div class="space-y-6">
        <x-card title="Riwayat Peminjaman Saya">
            @php
                $member = auth()->user()->member ?? null;
            @endphp

            @if ($member)
                @php
                    $borrowings = \App\Models\Borrowing::with(['book', 'returnRecord', 'confirmedBy', 'rejectedBy'])
                        ->where('member_id', $member->id)
                        ->latest()
                        ->paginate(10);
                @endphp

                @if ($borrowings->count())
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-500 uppercase bg-cream-100/80 dark:bg-slate-800 dark:text-slate-400">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">Buku</th>
                                    <th class="px-4 py-3">Tgl Pinjam</th>
                                    <th class="px-4 py-3">Tgl Kembali</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Kondisi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-cream-200 dark:divide-slate-700">
                                @foreach ($borrowings as $borrowing)
                                    <tr class="bg-white transition-colors hover:bg-cream-50 dark:bg-slate-900 dark:hover:bg-slate-800/60">
                                        <td class="px-4 py-3">{{ $loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage() }}</td>
                                        <td class="px-4 py-3">
                                            <p class="font-medium text-slate-800 dark:text-white">{{ $borrowing->book->title }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $borrowing->book->isbn }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $borrowing->borrow_date->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $borrowing->due_date->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">
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
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($borrowing->status === 'rejected' && $borrowing->rejection_reason)
                                                <span class="text-xs text-danger-600">{{ $borrowing->rejection_reason }}</span>
                                            @elseif ($borrowing->returnRecord)
                                                @if ($borrowing->returnRecord->condition === 'good')
                                                    <x-badge variant="success">Baik</x-badge>
                                                @elseif ($borrowing->returnRecord->condition === 'damaged')
                                                    <x-badge variant="warning">Rusak</x-badge>
                                                @elseif ($borrowing->returnRecord->condition === 'lost')
                                                    <x-badge variant="danger">Hilang</x-badge>
                                                @endif
                                            @else
                                                <span class="text-xs text-slate-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <x-pagination :paginator="$borrowings" />
                @else
                    <x-empty-state title="Belum ada riwayat" description="Anda belum pernah meminjam buku." icon="o-clock" />
                @endif
            @else
                <x-empty-state title="Data tidak ditemukan" description="Anda belum terdaftar sebagai anggota perpustakaan." icon="o-user" />
            @endif
        </x-card>
    </div>
</x-app-layout>
