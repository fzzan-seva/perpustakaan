@props(['title' => null, 'description' => null, 'icon' => 'o-folder-open'])

<div class="py-12 text-center">
    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-accent-100/60 ring-1 ring-accent-200/70">
        <x-icon :name="$icon" class="h-8 w-8 text-accent-600" />
    </div>
    @if ($title)
        <h3 class="mt-4 font-serif text-xl font-bold text-primary-900 dark:text-white">{{ $title }}</h3>
    @endif
    @if ($description)
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $description }}</p>
    @endif
    @if ($slot->isNotEmpty())
        <div class="mt-4">
            {{ $slot }}
        </div>
    @endif
</div>