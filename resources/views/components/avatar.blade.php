@props(['size' => 'md', 'name' => '', 'src' => null])

@php
$sizeClasses = match ($size) {
    'sm' => 'h-8 w-8 text-xs',
    'md' => 'h-10 w-10 text-sm',
    'lg' => 'h-12 w-12 text-base',
    'xl' => 'h-16 w-16 text-lg',
    default => 'h-10 w-10 text-sm',
};
@endphp

@if ($src)
    <img src="{{ $src }}" alt="{{ $name }}" {{ $attributes->merge(['class' => "$sizeClasses rounded-full object-cover ring-2 ring-white dark:ring-slate-800"]) }} />
@else
    <div {{ $attributes->merge(['class' => "$sizeClasses inline-flex items-center justify-center rounded-full bg-primary-100 font-semibold text-primary-700 ring-2 ring-white dark:bg-primary-900/30 dark:text-primary-400 dark:ring-slate-800"]) }}>
        {{ strtoupper(mb_substr($name ?: '?', 0, 1)) }}
    </div>
@endif
