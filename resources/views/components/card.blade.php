@props(['title' => null, 'description' => null, 'actions' => null, 'padding' => true])

<div {{ $attributes->merge(['class' => 'bookmark-accent rounded-2xl border border-cream-200 bg-white shadow-card']) }}>
    @if ($title || $actions)
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-cream-200 px-5 sm:px-6 py-4">
            <div>
                @if ($title)
                    <h3 class="font-serif text-xl font-bold text-primary-900">{{ $title }}</h3>
                @endif
                @if ($description)
                    <p class="mt-0.5 text-sm text-slate-500">{{ $description }}</p>
                @endif
            </div>
            @if ($actions)
                <div class="flex items-center gap-2">
                    @if (is_array($actions))
                        @foreach ($actions as $action)
                            <a href="{{ $action['href'] ?? '#' }}"
                               class="inline-flex items-center gap-1.5 rounded-xl px-3.5 py-2 text-xs font-semibold transition-all duration-200 hover:-translate-y-0.5
                               @if (($action['variant'] ?? 'primary') === 'primary')
                                   bg-gradient-to-r from-cta-500 to-cta-400 text-white shadow-md shadow-cta-600/20 hover:shadow-lg
                               @elseif (($action['variant'] ?? '') === 'danger')
                                   bg-danger-50 text-danger-700 hover:bg-danger-100
                               @elseif (($action['variant'] ?? '') === 'success')
                                   bg-success-50 text-success-700 hover:bg-success-100
                               @else
                                   bg-cream-100 text-primary-900 hover:bg-cream-200
                               @endif">
                                @if (isset($action['icon']))
                                    <x-icon :name="$action['icon']" class="h-4 w-4" />
                                @endif
                                {{ $action['label'] }}
                            </a>
                        @endforeach
                    @else
                        {{ $actions }}
                    @endif
                </div>
            @endif
        </div>
    @endif
    <div {{ $padding ? 'class="p-5 sm:p-6"' : '' }}>
        {{ $slot }}
    </div>
</div>