<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Penulis', 'href' => route('authors.index')],
        ['label' => 'Edit'],
    ]" />

    <div class="space-y-6">
        <x-card title="Edit Penulis">
            <form action="{{ route('authors.update', $author) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-1">
                        <x-input-label value="Nama Penulis" />
                        <x-text-input type="text" name="name" :value="old('name', $author->name)" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>

                    <div class="space-y-1 sm:col-span-2">
                        <x-input-label value="Bio" />
                        <textarea name="bio" rows="3" class="block w-full rounded-xl border-cream-200 bg-white px-3.5 py-2 text-sm text-slate-800 shadow-sm transition-all focus:border-accent-300 focus:outline-none focus:ring-2 focus:ring-accent-400/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200">{{ old('bio', $author->bio) }}</textarea>
                        <x-input-error :messages="$errors->get('bio')" />
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                    <a href="{{ route('authors.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                        Batal
                    </a>
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
