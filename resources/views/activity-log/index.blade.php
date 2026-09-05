<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Activity Log'],
    ]" />

    <div class="space-y-6">
        <x-card title="Activity Log" :description="'Riwayat aktivitas sistem'">
            <form action="{{ route('activity-log.index') }}" method="GET" class="mb-4">
                <div class="flex flex-col sm:flex-row gap-2">
                    <x-text-input type="text" name="search" :value="request('search')" placeholder="Cari aktivitas..." />
                    <x-primary-button type="submit" class="shrink-0">Cari</x-primary-button>
                </div>
            </form>

            @if ($items->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-cream-100/80 dark:bg-slate-800 dark:text-slate-400">
                            <tr>
                                <th class="px-4 py-3">Waktu</th>
                                <th class="px-4 py-3">Pengguna</th>
                                <th class="px-4 py-3">Aksi</th>
                                <th class="px-4 py-3">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200 dark:divide-slate-700">
                            @foreach ($items as $log)
                                <tr class="bg-white transition-colors hover:bg-cream-50 dark:bg-slate-900 dark:hover:bg-slate-800/60">
                                    <td class="whitespace-nowrap px-4 py-3 text-slate-500 dark:text-slate-400">
                                        {{ $log->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">
                                        {{ $log->user->name ?? 'System' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($log->action === 'create')
                                            <x-badge variant="success">Tambah</x-badge>
                                        @elseif ($log->action === 'update')
                                            <x-badge variant="info">Edit</x-badge>
                                        @elseif ($log->action === 'delete')
                                            <x-badge variant="danger">Hapus</x-badge>
                                        @elseif ($log->action === 'borrow')
                                            <x-badge variant="warning">Pinjam</x-badge>
                                        @elseif ($log->action === 'return')
                                            <x-badge variant="primary">Kembali</x-badge>
                                        @else
                                            <x-badge variant="gray">{{ $log->action }}</x-badge>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $log->description ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <x-pagination :paginator="$items" />
            @else
                <x-empty-state title="Belum ada aktivitas" description="Belum ada aktivitas yang tercatat dalam sistem." icon="o-clock" />
            @endif
        </x-card>
    </div>
</x-app-layout>
