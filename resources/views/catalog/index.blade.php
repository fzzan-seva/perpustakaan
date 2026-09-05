<x-app-layout>
    <x-breadcrumb :items="[['label' => 'Katalog Buku']]" />

    <div class="space-y-8">
        {{-- Hero --}}
        <section class="relative overflow-hidden rounded-3xl bg-primary-950 px-6 py-12 text-center shadow-card-hover sm:px-12 sm:py-16" data-reveal>
            {{-- Decorative pattern --}}
            <div class="pointer-events-none absolute inset-0 opacity-[0.07]">
                <svg class="h-full w-full" viewBox="0 0 600 300" preserveAspectRatio="xMidYMid slice">
                    <rect x="40" y="40" width="10" height="120" rx="3" fill="white"/>
                    <rect x="58" y="70" width="10" height="90" rx="3" fill="white" opacity="0.7"/>
                    <rect x="76" y="30" width="10" height="130" rx="3" fill="white" opacity="0.5"/>
                    <rect x="94" y="60" width="10" height="100" rx="3" fill="white" opacity="0.8"/>
                    <rect x="470" y="50" width="10" height="110" rx="3" fill="white" opacity="0.6"/>
                    <rect x="488" y="35" width="10" height="125" rx="3" fill="white" opacity="0.4"/>
                    <rect x="506" y="75" width="10" height="85" rx="3" fill="white" opacity="0.7"/>
                </svg>
            </div>
            {{-- Gold glow --}}
            <div class="pointer-events-none absolute -top-24 left-1/2 h-64 w-[36rem] -translate-x-1/2 rounded-full bg-accent-500/20 blur-3xl"></div>

            {{-- Floating books illustration (desktop) --}}
            <div class="pointer-events-none absolute right-10 top-1/2 hidden -translate-y-1/2 xl:block animate-float">
                <svg width="220" height="200" viewBox="0 0 220 200" fill="none">
                    <ellipse cx="110" cy="176" rx="96" ry="14" fill="#0b1426" opacity="0.5"/>
                    <g transform="rotate(-6 110 90)">
                        <rect x="30" y="52" width="22" height="122" rx="4" fill="#4670a6"/>
                        <rect x="54" y="38" width="22" height="136" rx="4" fill="#d5ab3b"/>
                        <rect x="78" y="46" width="22" height="128" rx="4" fill="#8db1d3"/>
                        <rect x="102" y="30" width="22" height="144" rx="4" fill="#e4734b"/>
                        <rect x="126" y="58" width="22" height="116" rx="4" fill="#c2942c"/>
                        <rect x="150" y="44" width="22" height="130" rx="4" fill="#2b476e"/>
                        <rect x="102" y="18" width="88" height="10" rx="3" fill="#0b1426" opacity="0.6"/>
                    </g>
                    <circle cx="196" cy="40" r="26" fill="#d5ab3b" opacity="0.15"/>
                    <circle cx="196" cy="40" r="15" fill="#d5ab3b" opacity="0.2"/>
                </svg>
            </div>

            <div class="relative z-10 mx-auto max-w-3xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold tracking-wide text-accent-200 ring-1 ring-white/20">
                    <x-icon name="o-book-open" class="h-4 w-4" />
                    Koleksi Perpustakaan Digital
                </span>
                <h1 class="mt-6 font-serif text-4xl font-bold leading-tight text-white sm:text-5xl">
                    Temukan Buku
                    <span class="bg-gradient-to-r from-accent-300 to-accent-500 bg-clip-text text-transparent">Favoritmu</span>
                </h1>
                <div class="mx-auto mt-5 h-1 w-20 rounded-full bg-gradient-to-r from-accent-400 to-cta-400"></div>
                <p class="mx-auto mt-5 max-w-xl text-base leading-relaxed text-white/70">
                    Jelajahi ribuan koleksi buku yang siap menemani perjalanan belajarmu. Pilih, pinjam, dan baca kapan saja.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="#koleksi" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-accent-400 to-accent-500 px-6 py-3 text-sm font-bold text-primary-950 shadow-lg shadow-accent-500/30 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-xl">
                        Jelajahi Koleksi
                        <x-icon name="o-arrow-down" class="h-4 w-4" />
                    </a>
                    <span class="inline-flex items-center gap-2 rounded-xl border border-white/15 px-5 py-3 text-sm font-medium text-white/85">
                        <x-icon name="o-sparkles" class="h-4 w-4 text-accent-300" />
                        {{ $books->total() }} koleksi tersedia
                    </span>
                </div>
            </div>
        </section>

        {{-- Floating search --}}
        <div class="relative z-20 -mt-8 mx-auto max-w-3xl" data-reveal>
            <x-card class="rounded-2xl shadow-card-hover ring-1 ring-cream-200">
                <form action="{{ route('catalog.index') }}" method="GET" class="grid grid-cols-1 items-end gap-3 p-4 sm:grid-cols-[1fr_auto]">
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <x-icon name="o-magnifying-glass" class="h-4 w-4 text-accent-600/70" />
                        </div>
                        <x-text-input type="text" name="search" :value="$search" placeholder="Cari judul, ISBN, atau pengarang..." class="!pl-10 w-full" />
                    </div>
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-[auto_auto]">
                        <x-select-input name="category" placeholder="Semua Kategori" class="min-w-[11rem]">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->books_count }})
                                </option>
                            @endforeach
                        </x-select-input>
                        <x-primary-button type="submit">
                            <x-icon name="o-magnifying-glass" class="h-4 w-4" />
                            Cari
                        </x-primary-button>
                    </div>
                </form>
            </x-card>
        </div>

        {{-- Section heading --}}
        <div class="flex items-end justify-between" data-reveal>
            <div>
                <h2 class="font-serif text-2xl font-bold text-primary-900 sm:text-3xl" id="koleksi">Koleksi Buku</h2>
                <div class="mt-1.5 h-1 w-14 rounded-full bg-gradient-to-r from-accent-400 to-cta-400"></div>
            </div>
            <p class="text-sm text-slate-500">Menampilkan {{ $books->total() }} buku</p>
        </div>

        {{-- Book grid --}}
        @if ($books->count())
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($books as $book)
                    <a href="{{ route('catalog.show', $book) }}"
                       class="group relative flex flex-col overflow-hidden rounded-2xl bg-white p-3 shadow-card ring-1 ring-cream-200 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-card-hover hover:ring-accent-300"
                       data-reveal
                       style="transition-delay: {{ ($loop->index % 4) * 60 }}ms">
                        {{-- Cover --}}
                        <div class="relative aspect-[3/4] overflow-hidden rounded-xl bg-gradient-to-br from-cream-100 to-cream-200">
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                     class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.07]">
                            @else
                                <div class="flex h-full w-full flex-col items-center justify-center gap-2 bg-gradient-to-br from-primary-800 via-primary-900 to-primary-950">
                                    <x-icon name="o-book-open" class="h-12 w-12 text-accent-300/80" />
                                    <span class="text-[10px] font-medium uppercase tracking-widest text-accent-200/60">Sampul tersedia</span>
                                </div>
                            @endif
                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-950/50 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                            <div class="absolute inset-x-3 bottom-3 flex items-center justify-between opacity-0 transition-all duration-300 translate-y-2 group-hover:translate-y-0 group-hover:opacity-100">
                                <span class="rounded-full bg-white/90 px-2.5 py-1 text-[10px] font-bold text-primary-900 backdrop-blur">Lihat Detail</span>
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-accent-400 text-primary-950 shadow-lg">
                                    <x-icon name="o-arrow-right" class="h-4 w-4" />
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-1 flex-col px-1.5 pb-1.5 pt-3">
                            <div class="flex items-center justify-between gap-2">
                                <x-badge variant="gold" size="sm">{{ $book->category->name }}</x-badge>
                                <x-badge variant="{{ $book->stock > 0 ? 'success' : 'danger' }}" size="sm">
                                    {{ $book->stock > 0 ? "Tersedia ({$book->stock})" : 'Tidak Tersedia' }}
                                </x-badge>
                            </div>
                            <h3 class="mt-2.5 font-serif text-[15px] font-bold leading-snug text-primary-900 line-clamp-2 transition-colors group-hover:text-primary-600">
                                {{ $book->title }}
                            </h3>
                            <p class="mt-1 text-xs text-slate-500">{{ $book->author->name }}</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-medium text-accent-600 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <x-icon name="o-sparkles" class="h-3.5 w-3.5" />
                                Pinjam buku ini
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div data-reveal>
                <x-pagination :paginator="$books" />
            </div>
        @else
            <x-empty-state title="Buku tidak ditemukan" description="Tidak ada buku yang cocok dengan pencarian Anda." icon="o-book-open" data-reveal />
        @endif
    </div>
</x-app-layout>