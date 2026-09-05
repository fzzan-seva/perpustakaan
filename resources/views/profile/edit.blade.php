<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Profil Saya</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="rounded-2xl border border-cream-200 bg-white p-6 shadow-card dark:border-slate-700 dark:bg-slate-800 sm:p-8">
                <div class="max-w-xl">@include('profile.partials.update-profile-information-form')</div>
            </div>

            <div class="rounded-2xl border border-cream-200 bg-white p-6 shadow-card dark:border-slate-700 dark:bg-slate-800 sm:p-8">
                <div class="max-w-xl">@include('profile.partials.update-password-form')</div>
            </div>

            <div class="rounded-2xl border border-danger-200 bg-white p-6 shadow-sm dark:border-danger-500/30 dark:bg-slate-800 sm:p-8">
                <div class="max-w-xl">@include('profile.partials.delete-user-form')</div>
            </div>
        </div>
    </div>
</x-app-layout>
