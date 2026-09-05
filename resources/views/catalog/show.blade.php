<x-app-layout>
    <x-breadcrumb :items="[
        ['label' => 'Katalog Buku', 'href' => route('catalog.index')],
        ['label' => $book->title],
    ]" />

    <div class="space-y-8">
        <section class="relative overflow-hidden rounded-3xl bg-white p-6 shadow-card ring-1 ring-cream-200 sm:p-10" data-reveal>
            {{-- Decorative watermark --}}
            <div class="pointer-events-none absolute -right-8 -top-8 text-accent-200/30">
                <x-icon name="o-book-open" class="h-40 w-40" />
            </div>

            <div class="relative grid grid-cols-1 gap-10 lg:grid-cols-[2fr_3fr] lg:gap-12">
                {{-- Cover presentation --}}
                <div class="mx-auto w-full max-w-[19rem]" data-reveal style="transition-delay:80ms">
                    <div class="relative">
                        <div class="absolute -inset-5 rounded-[2rem] bg-gradient-to-br from-accent-300/50 via-cream-200 to-transparent blur-2xl"></div>
                        <div class="absolute inset-0 translate-x-3 translate-y-3 rounded-2xl bg-primary-900/85"></div>
                        <div class="absolute inset-0 translate-x-1.5 translate-y-1.5 rounded-2xl bg-accent-400/75"></div>

                        <div class="relative aspect-[3/4] overflow-hidden rounded-2xl shadow-card-hover ring-1 ring-cream-200">
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full w-full flex-col items-center justify-center gap-4 bg-gradient-to-br from-primary-800 via-primary-900 to-primary-950 p-6 text-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-accent-400/15 ring-1 ring-accent-300/30">
                                        <x-icon name="o-book-open" class="h-8 w-8 text-accent-300" />
                                    </div>
                                    <p class="font-serif text-lg font-bold leading-snug text-accent-100">{{ $book->title }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- Floating stock badge --}}
                        <div class="absolute -right-3 -top-3">
                            <x-badge variant="{{ $book->stock > 0 ? 'success' : 'danger' }}" size="lg" class="shadow-lg shadow-primary-900/10">
                                {{ $book->stock > 0 ? "Tersedia ({$book->stock} eksemplar)" : 'Tidak Tersedia' }}
                            </x-badge>
                        </div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="space-y-6">
                    <div class="flex flex-wrap items-center gap-2" data-reveal style="transition-delay:120ms">
                        <x-badge variant="gold" size="lg">{{ $book->category->name }}</x-badge>
                        <x-badge variant="gray" size="lg">{{ $book->rack->name ?? 'Rak' }}</x-badge>
                    </div>

                    <div data-reveal style="transition-delay:160ms">
                        <h1 class="font-serif text-3xl font-bold leading-tight text-primary-900 sm:text-4xl">{{ $book->title }}</h1>
                        <p class="mt-2 flex items-center gap-2 text-sm text-slate-500">
                            <x-icon name="o-pencil-square" class="h-4 w-4 text-accent-600" />
                            <span class="font-semibold text-slate-700">oleh</span> {{ $book->author->name }}
                        </p>
                        <div class="mt-4 h-1 w-16 rounded-full bg-gradient-to-r from-accent-400 to-cta-400"></div>
                    </div>

                    {{-- Info tiles --}}
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2" data-reveal style="transition-delay:220ms">
                        <div class="rounded-2xl border border-cream-200 bg-cream-100/60 p-4">
                            <p class="flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-accent-700">
                                <x-icon name="o-identification" class="h-3.5 w-3.5" />
                                ISBN
                            </p>
                            <p class="mt-1 text-sm font-semibold text-primary-900">{{ $book->isbn }}</p>
                        </div>
                        <div class="rounded-2xl border border-cream-200 bg-cream-100/60 p-4">
                            <p class="flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-accent-700">
                                <x-icon name="o-building-library" class="h-3.5 w-3.5" />
                                Penerbit
                            </p>
                            <p class="mt-1 text-sm font-semibold text-primary-900">{{ $book->publisher->name }}</p>
                        </div>
                        <div class="rounded-2xl border border-cream-200 bg-cream-100/60 p-4">
                            <p class="flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-accent-700">
                                <x-icon name="o-bars-3-bottom-left" class="h-3.5 w-3.5" />
                                Rak
                            </p>
                            <p class="mt-1 text-sm font-semibold text-primary-900">{{ $book->rack->name }}</p>
                        </div>
                        <div class="rounded-2xl border border-cream-200 bg-cream-100/60 p-4">
                            <p class="flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-accent-700">
                                <x-icon name="o-map-pin" class="h-3.5 w-3.5" />
                                Lokasi Rak
                            </p>
                            <p class="mt-1 text-sm font-semibold text-primary-900">{{ $book->rack->location ?? '-' }}</p>
                        </div>
                    </div>

                    @if ($book->description)
                        <div class="relative rounded-2xl border border-cream-200 bg-cream-50 p-5" data-reveal style="transition-delay:280ms">
                            <span class="pointer-events-none absolute left-4 top-2 font-serif text-6xl leading-none text-accent-400/30">"</span>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-accent-700">Deskripsi</p>
                            <p class="mt-2 text-sm leading-relaxed text-slate-700">{{ $book->description }}</p>
                        </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-3 pt-2" data-reveal style="transition-delay:340ms">
                        <a href="{{ route('catalog.index') }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-cream-200 bg-white px-5 py-3 text-sm font-semibold text-primary-900 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-accent-300 hover:shadow-card">
                            <x-icon name="o-arrow-left" class="h-4 w-4" />
                            Kembali ke Katalog
                        </a>
                        @if (auth()->user()->hasRole('siswa') && $book->stock > 0)
                            <form action="{{ route('borrowings.request') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-cta-500 to-cta-400 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-cta-600/25 transition-all duration-200 hover:-translate-y-0.5 hover:from-cta-600 hover:to-cta-500 hover:shadow-xl active:translate-y-0">
                                    <x-icon name="o-arrow-left-start-on-rectangle" class="h-4 w-4" />
                                    Ajukan Peminjaman
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>