<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Anggota'],
    ]" />

    <div class="space-y-6">
        <x-card title="Manajemen Anggota" :actions="[['label' => 'Tambah Anggota', 'href' => route('members.create'), 'variant' => 'primary']]">
            <form action="{{ route('members.index') }}" method="GET" class="mb-4">
                <div class="flex flex-col sm:flex-row gap-2">
                    <x-text-input type="text" name="search" :value="request('search')" placeholder="Cari anggota..." />
                    <x-primary-button type="submit" class="shrink-0">Cari</x-primary-button>
                </div>
            </form>

            @if ($items->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-500 uppercase bg-cream-100/80 dark:bg-slate-800 dark:text-slate-400">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">NIS</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Telepon</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-cream-200 dark:divide-slate-700">
                            @foreach ($items as $member)
                                <tr class="bg-white transition-colors hover:bg-cream-50 dark:bg-slate-900 dark:hover:bg-slate-800/60">
                                    <td class="px-4 py-3">{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                                    <td class="px-4 py-3">{{ $member->nis }}</td>
                                    <td class="px-4 py-3">{{ $member->name }}</td>
                                    <td class="px-4 py-3">{{ $member->user->email ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $member->phone ?? '-' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('members.edit', $member) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary-50 px-3 py-1.5 text-xs font-medium text-primary-700 transition-colors hover:bg-primary-100 dark:bg-primary-500/10 dark:text-primary-400 dark:hover:bg-primary-500/20">
                                                Edit
                                            </a>
                                            <form action="{{ route('members.destroy', $member) }}" method="POST" data-confirm="Yakin ingin menghapus anggota ini?">
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
                <x-empty-state title="Belum ada data anggota" description="Mulai tambahkan anggota baru untuk perpustakaan." icon="users" />
            @endif
        </x-card>
    </div>
</x-app-layout>
