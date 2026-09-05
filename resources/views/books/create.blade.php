<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Manajemen Buku', 'href' => route('books.index')],
        ['label' => 'Tambah'],
    ]" />

    <div class="space-y-6">
        <x-card title="Tambah Buku">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="space-y-1">
                        <x-input-label value="ISBN" />
                        <x-text-input type="text" name="isbn" :value="old('isbn')" required />
                        <x-input-error :messages="$errors->get('isbn')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Judul Buku" />
                        <x-text-input type="text" name="title" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Kategori" />
                        <x-select-input name="category_id" placeholder="Pilih Kategori" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('category_id')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Penulis" />
                        <x-select-input name="author_id" placeholder="Pilih Penulis">
                            <option value="">- Pilih Penulis -</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('author_id')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Sampul Buku" />
                        <input type="file" name="cover_image" accept="image/*"
                               class="block w-full rounded-xl border-cream-200 bg-white text-sm text-slate-800 shadow-sm file:mr-3 file:rounded-lg file:border-0 file:bg-accent-100 file:px-3 file:py-2 file:text-sm file:font-bold file:text-accent-800 hover:file:bg-accent-200 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200 dark:file:bg-accent-900/30 dark:file:text-accent-400">
                        <x-input-error :messages="$errors->get('cover_image')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Penerbit" />
                        <x-select-input name="publisher_id" placeholder="Pilih Penerbit" required>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('publisher_id')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Rak Buku" />
                        <x-select-input name="rack_id" placeholder="Pilih Rak" required>
                            @foreach ($racks as $rack)
                                <option value="{{ $rack->id }}" {{ old('rack_id') == $rack->id ? 'selected' : '' }}>
                                    {{ $rack->name }}
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('rack_id')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Stok" />
                        <x-text-input type="number" name="stock" :value="old('stock', 0)" min="0" required />
                        <x-input-error :messages="$errors->get('stock')" />
                    </div>

                    <div class="space-y-1">
                        <x-input-label value="Deskripsi" />
                        <textarea name="description" rows="3" class="block w-full rounded-xl border-cream-200 bg-white px-3.5 py-2 text-sm text-slate-800 shadow-sm transition-all focus:border-accent-300 focus:outline-none focus:ring-2 focus:ring-accent-400/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" />
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                    <a href="{{ route('books.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                        Batal
                    </a>
                    <x-primary-button>Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
