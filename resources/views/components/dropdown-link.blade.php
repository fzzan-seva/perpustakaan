@props(['href' => '#'])

<a {{ $attributes->merge(['href' => $href, 'class' => 'block px-4 py-2 text-sm leading-5 text-slate-600 transition-colors hover:bg-cream-100/70 hover:text-primary-900 focus:bg-cream-100/70 focus:outline-none dark:text-slate-300 dark:hover:bg-slate-600/50 dark:focus:bg-slate-600/50']) }}>
    {{ $slot }}
</a>
