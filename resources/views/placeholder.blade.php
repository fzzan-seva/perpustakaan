<x-app-layout>
    <x-breadcrumb :items="[['label' => $title]]" />

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">{{ $title }}</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $description }}</p>
        </div>

        <x-card>
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-50 dark:bg-primary-500/10">
                    <x-icon :name="$icon" class="h-8 w-8 text-primary-500" />
                </div>
                <h2 class="mt-4 text-lg font-semibold text-slate-800 dark:text-white">Segera Hadir</h2>
                <p class="mt-2 max-w-sm text-sm text-slate-500 dark:text-slate-400">
                    Halaman ini masih dalam tahap pengembangan. Fitur {{ strtolower($title) }} akan segera tersedia.
                </p>
            </div>
        </x-card>
    </div>
</x-app-layout>
