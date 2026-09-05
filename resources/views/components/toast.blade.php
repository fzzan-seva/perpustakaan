@props(['type' => 'info', 'message' => null, 'autoHide' => true, 'duration' => 5000])

@if (session('success') || session('error') || session('warning') || session('info') || $message)
<div x-data="{
        show: true,
        type: '{{ $type }}',
        message: @js($message ?? session('success') ?? session('error') ?? session('warning') ?? session('info')),
        get isSuccess() { return this.type === 'success'; },
        get isError() { return this.type === 'error'; },
        get isWarning() { return this.type === 'warning'; },
        get isInfo() { return this.type === 'info'; },
    }"
    x-init="
        @if (session('success')) type = 'success'; message = @js(session('success')); @endif
        @if (session('error')) type = 'error'; message = @js(session('error')); @endif
        @if (session('warning')) type = 'warning'; message = @js(session('warning')); @endif
        @if (session('info')) type = 'info'; message = @js(session('info')); @endif
        if ({{ $autoHide ? 'true' : 'false' }} && message) {
            setTimeout(() => { show = false; }, {{ $duration }});
        }
    "
    x-show="show && message"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-4 right-4 z-[100] max-w-sm"
    x-cloak>
    <div class="flex items-start gap-3 rounded-2xl border p-4 shadow-card-hover backdrop-blur-md"
         :class="{
             'border-emerald-200 bg-emerald-50 dark:border-emerald-800 dark:bg-emerald-900/20': isSuccess,
             'border-danger-200 bg-danger-50 dark:border-danger-800 dark:bg-danger-900/20': isError,
             'border-warning-200 bg-warning-50 dark:border-warning-800 dark:bg-warning-900/20': isWarning,
             'border-accent-200 bg-accent-50 dark:border-accent-800 dark:bg-accent-900/20': isInfo,
         }">
        <div class="shrink-0 mt-0.5">
            <x-icon name="o-check-circle" class="h-5 w-5 text-emerald-500" x-show="isSuccess" />
            <x-icon name="o-x-circle" class="h-5 w-5 text-danger-500" x-show="isError" />
            <x-icon name="o-exclamation-triangle" class="h-5 w-5 text-warning-500" x-show="isWarning" />
            <x-icon name="o-information-circle" class="h-5 w-5 text-accent-500" x-show="isInfo" />
        </div>
        <div class="flex-1">
            <p class="text-sm font-medium"
               :class="{
                   'text-emerald-800 dark:text-emerald-200': isSuccess,
                   'text-danger-700 dark:text-danger-200': isError,
                   'text-warning-700 dark:text-warning-200': isWarning,
                   'text-accent-700 dark:text-accent-200': isInfo,
               }" x-text="message">
            </p>
        </div>
        <button @click="show = false" class="shrink-0 rounded-lg p-1 transition-colors"
                :class="{
                    'text-emerald-500 hover:bg-emerald-100 dark:hover:bg-emerald-900/30': isSuccess,
                    'text-danger-500 hover:bg-danger-100 dark:hover:bg-danger-900/30': isError,
                    'text-warning-500 hover:bg-warning-100 dark:hover:bg-warning-900/30': isWarning,
                    'text-accent-500 hover:bg-accent-100 dark:hover:bg-accent-900/30': isInfo,
                }">
            <x-icon name="o-x-mark" class="h-4 w-4" />
        </button>
    </div>
</div>
@endif
