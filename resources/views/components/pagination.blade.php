@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        $elements = [];
        if ($lastPage <= 7) {
            for ($i = 1; $i <= $lastPage; $i++) {
                $elements[] = [$i => $paginator->url($i)];
            }
        } else {
            $elements[] = [1 => $paginator->url(1)];
            if ($currentPage > 3) {
                $elements[] = '...';
            }
            $start = max(2, $currentPage - 1);
            $end = min($lastPage - 1, $currentPage + 1);
            for ($i = $start; $i <= $end; $i++) {
                $elements[] = [$i => $paginator->url($i)];
            }
            if ($currentPage < $lastPage - 2) {
                $elements[] = '...';
            }
            $elements[] = [$lastPage => $paginator->url($lastPage)];
        }
    @endphp

<nav class="flex items-center justify-between" aria-label="Pagination">
    <div class="hidden sm:block">
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Menampilkan
            <span class="font-medium text-slate-700 dark:text-slate-200">{{ $paginator->firstItem() }}</span>
            sampai
            <span class="font-medium text-slate-700 dark:text-slate-200">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-medium text-slate-700 dark:text-slate-200">{{ $paginator->total() }}</span>
            data
        </p>
    </div>
    <div class="flex items-center gap-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-300 dark:text-slate-600">
                <x-icon name="o-chevron-left" class="h-4 w-4" />
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-accent-100/70 hover:text-primary-900 dark:text-slate-400 dark:hover:bg-slate-700">
                <x-icon name="o-chevron-left" class="h-4 w-4" />
            </a>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="inline-flex h-9 w-9 items-center justify-center text-sm text-slate-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-primary-900 text-sm font-semibold text-accent-200 shadow-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-sm text-slate-500 transition-colors hover:bg-accent-100/70 hover:text-primary-900 dark:text-slate-400 dark:hover:bg-slate-700">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-accent-100/70 hover:text-primary-900 dark:text-slate-400 dark:hover:bg-slate-700">
                <x-icon name="o-chevron-right" class="h-4 w-4" />
            </a>
        @else
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-300 dark:text-slate-600">
                <x-icon name="o-chevron-right" class="h-4 w-4" />
            </span>
        @endif
    </div>
</nav>
@endif
