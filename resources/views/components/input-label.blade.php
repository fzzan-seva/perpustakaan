@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-primary-900 dark:text-slate-200']) }}>
    {{ $value ?? $slot }}
</label>