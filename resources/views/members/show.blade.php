<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Anggota', 'href' => route('members.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Anggota">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <dl class="space-y-2">
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">NIS</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $member->nis }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Nama</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $member->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Email</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $member->user->email ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Telepon</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $member->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Alamat</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $member->address ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Dibuat</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $member->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                <a href="{{ route('members.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
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
        </x-card>
    </div>
</x-app-layout>
