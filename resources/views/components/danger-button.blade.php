@props(['type' => 'button'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center justify-center rounded-lg bg-red-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-red-600/20 transition duration-200 hover:bg-red-700 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-500/50 disabled:opacity-50 disabled:cursor-not-allowed dark:shadow-red-600/10']) }}>
    {{ $slot }}
</button>
