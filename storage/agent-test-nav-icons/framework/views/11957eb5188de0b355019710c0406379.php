<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['user' => null, 'size' => 'md', 'class' => '', 'showChevron' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['user' => null, 'size' => 'md', 'class' => '', 'showChevron' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $sizes = [
        'sm' => 'h-8 w-8',
        'md' => 'h-12 w-12',
        'lg' => 'h-16 w-16',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];

    $initials = collect(explode(' ', trim($user?->name ?? '')))
        ->filter()
        ->take(2)
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->implode('');
?>

<div class="relative inline-flex items-center justify-center <?php echo e($class); ?>">
    <!-- Gradient ring effect -->
    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-blue-600 to-violet-600 p-0.5 opacity-100 transition-opacity duration-300"></div>

    <!-- Avatar container -->
    <div class="relative <?php echo e($sizeClass); ?> rounded-full overflow-hidden bg-gradient-to-br from-blue-100 to-violet-100 ring-2 ring-white shadow-lg shadow-blue-600/20 dark:from-blue-900 dark:to-violet-900 dark:ring-slate-900">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user && \Laravel\Jetstream\Jetstream::managesProfilePhotos() && $user->profile_photo_url): ?>
            <img
                class="h-full w-full object-cover"
                src="<?php echo e($user->profile_photo_url); ?>"
                alt="<?php echo e($user->name); ?>"
            >
        <?php else: ?>
            <!-- Gradient text for initials -->
            <div class="h-full w-full flex items-center justify-center">
                <span class="font-bold text-xs sm:text-sm bg-gradient-to-r from-blue-600 to-violet-600 bg-clip-text text-transparent dark:from-blue-300 dark:to-violet-300">
                    <?php echo e($initials); ?>

                </span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Optional glow effect -->
    <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-blue-500 to-violet-500 opacity-30 blur transition-opacity duration-300 -z-10"></div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showChevron): ?>
        <span class="pointer-events-none ms-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-slate-100 text-slate-600 ring-1 ring-slate-200 transition group-hover:bg-white group-hover:text-slate-800 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700 dark:group-hover:bg-slate-700 dark:group-hover:text-slate-100">
            <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.51a.75.75 0 0 1-1.08 0l-4.25-4.51a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
            </svg>
        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\sub\resources\views/components/profile-avatar.blade.php ENDPATH**/ ?>