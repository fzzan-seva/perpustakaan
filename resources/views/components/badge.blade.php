@props(['variant' => 'default', 'size' => 'md'])

@php
$variantClasses = match ($variant) {
    'primary' => 'bg-primary-100 text-primary-800',
    'gold' => 'bg-accent-100 text-accent-800',
    'success' => 'bg-success-100 text-success-700',
    'warning' => 'bg-warning-100 text-warning-700',
    'danger' => 'bg-danger-100 text-danger-700',
    'info' => 'bg-accent-100 text-accent-800',
    'gray' => 'bg-slate-100 text-slate-600',
    default => 'bg-slate-100 text-slate-600',
};

$sizeClasses = match ($size) {
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-1 text-xs',
    'lg' => 'px-3 py-1 text-sm',
    default => 'px-2.5 py-1 text-xs',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1 rounded-full font-semibold $variantClasses $sizeClasses"]) }}>
    {{ $slot }}
</span>