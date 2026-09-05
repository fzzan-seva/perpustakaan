@props(['disabled' => false, 'placeholder' => 'Pilih...'])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border-cream-200 bg-white px-3.5 py-2 text-sm text-slate-800 shadow-sm transition-all focus:border-accent-300 focus:outline-none focus:ring-2 focus:ring-accent-400/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-200']) }}>
    <option value="">{{ $placeholder }}</option>
    {{ $slot }}
</select>