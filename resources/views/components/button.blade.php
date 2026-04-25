@props(['type' => 'submit'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition duration-200 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500/50 disabled:opacity-50 disabled:cursor-not-allowed dark:shadow-blue-600/10']) }}>
    {{ $slot }}
</button>
