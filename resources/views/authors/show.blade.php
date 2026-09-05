<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Penulis', 'href' => route('authors.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Penulis">
            <div class="space-y-4">
                <div>
                    <x-input-label value="Nama" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $author->name }}</p>
                </div>

                <div>
                    <x-input-label value="Bio" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $author->bio ?? '-' }}</p>
                </div>

                <div>
                    <x-input-label value="Jumlah Buku" />
                    <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $author->books_count ?? $author->books->count() }}</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-2">
                <a href="{{ route('authors.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
