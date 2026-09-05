@props(['title' => 'Konfirmasi', 'description' => 'Apakah Anda yakin?', 'confirmText' => 'Ya, Hapus', 'cancelText' => 'Batal', 'variant' => 'danger'])

@php
$confirmButtonClasses = match ($variant) {
    'danger' => 'bg-gradient-to-r from-danger-600 to-danger-500 hover:from-danger-700 hover:to-danger-600 focus:ring-danger-500',
    'warning' => 'bg-gradient-to-r from-warning-600 to-warning-500 hover:from-warning-700 hover:to-warning-600 focus:ring-warning-500',
    'primary' => 'bg-gradient-to-r from-primary-900 to-primary-700 hover:from-primary-950 hover:to-primary-800 focus:ring-primary-900',
    default => 'bg-gradient-to-r from-danger-600 to-danger-500 hover:from-danger-700 hover:to-danger-600 focus:ring-danger-500',
};
@endphp

<x-modal :name="$name" :maxWidth="'md'" {{ $attributes }}>
    <div class="p-6">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full
                {{ $variant === 'danger' ? 'bg-danger-50 dark:bg-danger-500/10' : ($variant === 'warning' ? 'bg-warning-50 dark:bg-warning-500/10' : 'bg-accent-100 dark:bg-accent-900/30') }}">
                <x-icon name="o-exclamation-triangle" class="h-6 w-6
                    {{ $variant === 'danger' ? 'text-danger-600 dark:text-danger-400' : ($variant === 'warning' ? 'text-warning-600 dark:text-warning-400' : 'text-accent-700 dark:text-accent-400') }}" />
            </div>
            <div class="flex-1">
                <h3 class="font-serif text-lg font-bold text-primary-900 dark:text-white">{{ $title }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $description }}</p>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <button @click="$dispatch('close-modal', '{{ $name }}')"
                    class="inline-flex items-center gap-2 rounded-xl border border-cream-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-accent-300 hover:bg-cream-100 focus:outline-none focus:ring-2 focus:ring-accent-400/30 focus:ring-offset-2 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600">
                {{ $cancelText }}
            </button>
            <form method="POST" action="{{ $action ?? '#' }}" id="confirm-form-{{ $name }}">
                @csrf
                @method($method ?? 'DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $confirmButtonClasses }}">
                    {{ $confirmText }}
                </button>
            </form>
        </div>
    </div>
</x-modal>
