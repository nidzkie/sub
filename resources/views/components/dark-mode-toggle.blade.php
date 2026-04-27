@props(['class' => ''])

<button
    @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
    type="button"
    class="inline-flex items-center justify-center rounded-lg p-2.5 text-sm text-slate-500 hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200 transition {{ $class }}"
    :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
    title="Toggle dark mode"
>
    <!-- Sun icon (light mode) -->
    <svg
        x-show="!darkMode"
        class="h-5 w-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1m-16 0H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
    </svg>

    <!-- Moon icon (dark mode) -->
    <svg
        x-show="darkMode"
        class="h-5 w-5"
        fill="currentColor"
        viewBox="0 0 20 20"
    >
        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
    </svg>
</button>
