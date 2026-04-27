<?php
    $normalizedTitle = strtolower(trim(strip_tags((string) $title)));

    $sectionMeta = match (true) {
        str_contains($normalizedTitle, 'profile') => [
            'badge' => 'bg-blue-50 text-blue-700 ring-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:ring-blue-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75a17.933 17.933 0 01-7.5-1.632Z" />',
        ],
        str_contains($normalizedTitle, 'password') => [
            'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-300 dark:ring-emerald-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16.5 10.5V7.875a4.5 4.5 0 10-9 0V10.5m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6A2.25 2.25 0 0117.25 21h-10.5A2.25 2.25 0 014.5 18.75v-6A2.25 2.25 0 016.75 10.5Z" />',
        ],
        str_contains($normalizedTitle, 'factor') => [
            'badge' => 'bg-violet-50 text-violet-700 ring-violet-200 dark:bg-violet-900/30 dark:text-violet-300 dark:ring-violet-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0Z" />',
        ],
        str_contains($normalizedTitle, 'browser') => [
            'badge' => 'bg-amber-50 text-amber-700 ring-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:ring-amber-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-6A2.25 2.25 0 016.75 17.25V6.75A2.25 2.25 0 019 4.5h6a2.25 2.25 0 012.25 2.25ZM10.5 17.25h3" />',
        ],
        str_contains($normalizedTitle, 'delete') => [
            'badge' => 'bg-rose-50 text-rose-700 ring-rose-200 dark:bg-rose-900/30 dark:text-rose-300 dark:ring-rose-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0115.916 21.75H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0V4.875c0-1.043-.814-1.912-1.856-1.96a51.964 51.964 0 00-3.288 0C9.564 2.963 8.75 3.832 8.75 4.875v.518" />',
        ],
        default => [
            'badge' => 'bg-slate-100 text-slate-700 ring-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.5 3.75h9A2.25 2.25 0 0118.75 6v12A2.25 2.25 0 0116.5 20.25h-9A2.25 2.25 0 015.25 18V6A2.25 2.25 0 017.5 3.75Z" />',
        ],
    };
?>

<div class="flex justify-between md:col-span-1">
    <div class="px-4 sm:px-0">
        <div class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold ring-1 <?php echo e($sectionMeta['badge']); ?>">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <?php echo $sectionMeta['icon']; ?>

            </svg>
            <span><?php echo e($title); ?></span>
        </div>

        <p class="mt-3 text-sm text-slate-600 dark:text-slate-400">
            <?php echo e($description); ?>

        </p>
    </div>

    <div class="px-4 sm:px-0">
        <?php echo e($aside ?? ''); ?>

    </div>
</div>
<?php /**PATH C:\laragon\www\sub\resources\views/components/section-title.blade.php ENDPATH**/ ?>