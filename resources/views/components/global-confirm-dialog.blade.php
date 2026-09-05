<div x-data x-show="$store.confirmDialog.open" x-cloak
     class="fixed inset-0 z-[90] flex items-end justify-center p-4 sm:items-center"
     role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-200"
         :class="$store.confirmDialog.open ? 'opacity-100' : 'opacity-0'"
         @click="$store.confirmDialog.cancel()"></div>

    {{-- Dialog panel --}}
    <div class="relative w-full max-w-md rounded-2xl border border-cream-200 bg-white p-6 shadow-card-hover ring-1 ring-primary-900/5 dark:border-slate-700 dark:bg-slate-800
                transition-all duration-200"
         :class="$store.confirmDialog.open ? 'opacity-100 translate-y-0 scale-100' : 'opacity-0 translate-y-4 scale-95'"
         @keydown.escape.window="$store.confirmDialog.cancel()">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-danger-50 dark:bg-danger-500/10">
                <x-icon name="o-exclamation-triangle" class="h-6 w-6 text-danger-600 dark:text-danger-400" />
            </div>
            <div class="flex-1">
                <h3 class="font-serif text-lg font-bold text-primary-900 dark:text-white">Konfirmasi</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400" x-text="$store.confirmDialog.message"></p>
            </div>
        </div>
        <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
            <button type="button" @click="$store.confirmDialog.cancel()"
                    class="inline-flex items-center justify-center rounded-xl border border-cream-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-accent-300 hover:bg-cream-100 focus:outline-none focus:ring-2 focus:ring-accent-400/30 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600">
                Batal
            </button>
            <button type="button" @click="$store.confirmDialog.accept()"
                    class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-danger-600 to-danger-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:from-danger-700 hover:to-danger-600 focus:outline-none focus:ring-2 focus:ring-danger-500 focus:ring-offset-2">
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>
