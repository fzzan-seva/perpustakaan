@props(['items' => []])

@php
    $homeRoute = auth()->user()->hasRole('siswa') ? route('catalog.index') : route('dashboard');
@endphp

@if (count($items) > 0)
<nav class="mb-6 flex" aria-label="Breadcrumb">
    <ol class="flex items-center gap-1.5 text-sm">
        <li>
            <a href="{{ $homeRoute }}" class="text-accent-600 transition-colors hover:text-accent-700 dark:text-accent-400 dark:hover:text-accent-300">
                <x-icon name="o-home" class="h-4 w-4" />
            </a>
        </li>
        @foreach ($items as $index => $item)
            <li class="flex items-center gap-1.5">
                <x-icon name="o-chevron-right" class="h-3.5 w-3.5 text-accent-400/60 dark:text-slate-600" />
                @if (isset($item['href']) && $index !== count($items) - 1)
                    <a href="{{ $item['href'] }}" class="text-slate-400 transition-colors hover:text-primary-900 dark:text-slate-500 dark:hover:text-slate-300">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="font-semibold text-primary-900 dark:text-slate-200">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
