@props(['href' => '#', 'active' => false])

@php
$classes = $active
    ? 'inline-flex items-center gap-1.5 border-b-2 border-primary-500 pb-1 text-sm font-medium leading-5 text-primary-600 transition duration-150 ease-in-out focus:border-primary-500 focus:outline-none dark:text-primary-400'
    : 'inline-flex items-center gap-1.5 border-b-2 border-transparent pb-1 text-sm font-medium leading-5 text-slate-500 transition duration-150 ease-in-out hover:border-slate-300 hover:text-slate-700 focus:border-slate-300 focus:text-slate-700 focus:outline-none dark:text-slate-400 dark:hover:border-slate-600 dark:hover:text-slate-300';
@endphp

<a {{ $attributes->merge(['href' => $href, 'class' => $classes]) }}>
    {{ $slot }}
</a>
