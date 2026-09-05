<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Penerbit', 'href' => route('publishers.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Penerbit">
            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="space-y-1">
                    <x-input-label value="Nama" />
                    <p class="text-sm text-slate-900 dark:text-slate-100">{{ $publisher->name }}</p>
                </div>

                <div class="space-y-1">
                    <x-input-label value="Email" />
                    <p class="text-sm text-slate-900 dark:text-slate-100">{{ $publisher->email ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <x-input-label value="Telepon" />
                    <p class="text-sm text-slate-900 dark:text-slate-100">{{ $publisher->phone ?? '-' }}</p>
                </div>

                <div class="space-y-1">
                    <x-input-label value="Jumlah Buku" />
                    <p class="text-sm text-slate-900 dark:text-slate-100">{{ $publisher->books_count ?? $publisher->books->count() }}</p>
                </div>

                <div class="space-y-1 sm:col-span-2">
                    <x-input-label value="Alamat" />
                    <p class="text-sm text-slate-900 dark:text-slate-100">{{ $publisher->address ?? '-' }}</p>
                </div>
            </dl>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                <a href="{{ route('publishers.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
