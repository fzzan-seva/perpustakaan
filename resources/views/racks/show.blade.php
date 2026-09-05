<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Rak Buku', 'href' => route('racks.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Rak">
            <div class="space-y-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <x-input-label value="Nama" class="mb-1" />
                        <p class="text-sm text-slate-800 dark:text-slate-200">{{ $rack->name }}</p>
                    </div>

                    <div>
                        <x-input-label value="Lokasi" class="mb-1" />
                        <p class="text-sm text-slate-800 dark:text-slate-200">{{ $rack->location ?? '-' }}</p>
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label value="Deskripsi" class="mb-1" />
                        <p class="text-sm text-slate-800 dark:text-slate-200">{{ $rack->description ?? '-' }}</p>
                    </div>

                    <div>
                        <x-input-label value="Jumlah Buku" class="mb-1" />
                        <p class="text-sm text-slate-800 dark:text-slate-200">{{ $rack->books_count ?? $rack->books->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-2">
                <a href="{{ route('racks.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
