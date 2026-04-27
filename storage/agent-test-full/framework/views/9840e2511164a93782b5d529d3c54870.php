<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'button']));

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

foreach (array_filter((['type' => 'button']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<button <?php echo e($attributes->merge(['type' => $type, 'class' => 'inline-flex items-center justify-center rounded-lg bg-red-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-red-600/20 transition duration-200 hover:bg-red-700 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-red-500/50 disabled:opacity-50 disabled:cursor-not-allowed dark:shadow-red-600/10'])); ?>>
    <?php echo e($slot); ?>

</button>
<?php /**PATH C:\laragon\www\sub\resources\views/components/danger-button.blade.php ENDPATH**/ ?>