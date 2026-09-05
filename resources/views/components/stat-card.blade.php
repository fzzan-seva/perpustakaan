@props([
    'title',
    'value' => '0',
    'icon' => 'o-chart-bar',
    'trend' => null,
    'trendDirection' => 'up',
    'color' => 'primary',
    'route' => null,
])

@php
$colorClasses = match ($color) {
    'primary' => 'bg-primary-50 text-primary-600',
    'success' => 'bg-success-50 text-success-600',
    'warning' => 'bg-warning-50 text-warning-600',
    'danger' => 'bg-danger-50 text-danger-600',
    'info' => 'bg-accent-50 text-accent-600',
    default => 'bg-primary-50 text-primary-600',
};
@endphp

@if ($route)
<a href="{{ route($route) }}" {{ $attributes->merge(['class' => 'stat-card-library block']) }}>
@else
<div {{ $attributes->merge(['class' => 'stat-card-library']) }}>
@endif
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-slate-500">{{ $title }}</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">{{ $value }}</p>
            @if ($trend)
                <div class="mt-2 flex items-center gap-1">
                    @if ($trendDirection === 'up')
                        <x-icon name="o-arrow-up-right" class="h-4 w-4 text-success-500" />
                        <span class="text-sm font-medium text-success-600">{{ $trend }}</span>
                    @else
                        <x-icon name="o-arrow-down-right" class="h-4 w-4 text-danger-500" />
                        <span class="text-sm font-medium text-danger-600">{{ $trend }}</span>
                    @endif
                    <span class="text-sm text-slate-400">dari bulan lalu</span>
                </div>
            @endif
        </div>
        <div class="rounded-xl p-3 {{ $colorClasses }}">
            <x-icon :name="$icon" class="h-6 w-6" />
        </div>
    </div>
@if ($route)
</a>
@else
</div>
@endif
