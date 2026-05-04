<footer class="border-t border-slate-200/70 bg-white/70 backdrop-blur-xl dark:border-slate-700/70 dark:bg-slate-950/70">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-8 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-violet-600 text-white shadow-lg shadow-blue-600/25">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 8-9-5-9 5m18 0-9 5m9-5v8l-9 5m0-8L3 8m9 5v8M3 8v8l9 5" />
                </svg>
            </span>
            <div>
                <p class="text-sm font-extrabold text-blue-600 dark:text-blue-400">Campus<span class="text-violet-600 dark:text-violet-400">Rent</span></p>
                <p class="text-xs text-slate-500 dark:text-slate-400">University of Mindanao community marketplace</p>
            </div>
        </div>

        <div class="flex flex-col items-start gap-2 text-xs text-slate-500 dark:text-slate-400 sm:items-end">
            <span>&copy; {{ now()->year }} Campus Rental. Built for students.</span>
            <div class="flex items-center gap-3">
                <a href="{{ route('terms.show') }}" class="transition hover:text-slate-900 dark:hover:text-slate-200">Terms</a>
                <a href="{{ route('policy.show') }}" class="transition hover:text-slate-900 dark:hover:text-slate-200">Privacy</a>
                <a href="{{ route('help-center') }}" class="transition hover:text-slate-900 dark:hover:text-slate-200">Help Center</a>
            </div>
        </div>
    </div>
</footer>
