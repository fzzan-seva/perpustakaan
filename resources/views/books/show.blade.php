<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => route('dashboard')],
        ['label' => 'Manajemen Buku', 'href' => route('books.index')],
        ['label' => 'Detail'],
    ]" />

    <div class="space-y-6">
        <x-card title="Detail Buku">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <dl class="space-y-2">
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">ISBN</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $book->isbn }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Judul</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $book->title }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Kategori</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">
                            <a href="{{ route('categories.show', $book->category) }}" class="text-primary-600 hover:underline dark:text-primary-400">{{ $book->category->name }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Sampul Buku</dt>
                        <dd class="mt-0.5">
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="h-48 w-36 rounded-lg object-cover shadow-sm">
                            @else
                                <span class="text-sm text-slate-400">Tidak ada sampul</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Penerbit</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">
                            <a href="{{ route('publishers.show', $book->publisher) }}" class="text-primary-600 hover:underline dark:text-primary-400">{{ $book->publisher->name }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Rak</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">
                            <a href="{{ route('racks.show', $book->rack) }}" class="text-primary-600 hover:underline dark:text-primary-400">{{ $book->rack->name }}</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Stok</dt>
                        <dd class="mt-0.5">
                            <x-badge variant="{{ $book->stock > 0 ? 'success' : 'danger' }}">{{ $book->stock }}</x-badge>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Deskripsi</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $book->description ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase text-slate-500 dark:text-slate-400">Dibuat</dt>
                        <dd class="mt-0.5 text-sm text-slate-700 dark:text-slate-200">{{ $book->created_at->format('d/m/Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="mt-6 flex flex-wrap items-center justify-end gap-3">
                <a href="{{ route('books.index') }}" class="rounded-xl border border-cream-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all hover:border-accent-300 hover:bg-cream-100 dark:border-slate-600 dark:text-slate-300 dark:hover:bg-slate-700">
                    Kembali
                </a>
                <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center gap-1 rounded-lg bg-primary-50 px-3 py-1.5 text-xs font-medium text-primary-700 transition-colors hover:bg-primary-100 dark:bg-primary-500/10 dark:text-primary-400 dark:hover:bg-primary-500/20">
                    Edit
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" data-confirm="Yakin ingin menghapus buku ini?">
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
