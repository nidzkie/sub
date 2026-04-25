@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:col-span-2 md:mt-0">
        <form wire:submit="{{ $submit }}">
            <div class="rounded-t-2xl border border-slate-200/70 bg-white/80 px-4 py-5 shadow-lg shadow-slate-900/5 backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:shadow-xl sm:p-6 dark:border-slate-700/70 dark:bg-slate-900/80 dark:shadow-slate-900/40 dark:hover:shadow-slate-900/60 {{ isset($actions) ? '' : 'rounded-b-2xl' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end rounded-b-2xl border-x border-b border-slate-200/70 bg-slate-50/90 px-4 py-3 text-end shadow-lg shadow-slate-900/5 transition duration-300 hover:shadow-xl sm:px-6 dark:border-slate-700/70 dark:bg-slate-900/75 dark:shadow-slate-900/40 dark:hover:shadow-slate-900/60">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
