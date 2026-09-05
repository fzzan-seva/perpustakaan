<button @click="
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    "
    class="p-2 rounded-lg text-slate-500 hover:bg-cream-200/70 dark:text-slate-400 dark:hover:bg-slate-700 transition-colors"
    title="Toggle dark mode">
    <x-icon name="o-sun" class="h-5 w-5 hidden dark:block" />
    <x-icon name="o-moon" class="h-5 w-5 block dark:hidden" />
</button>
