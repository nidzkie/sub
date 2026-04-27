<div class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased transition-colors dark:bg-slate-950 dark:text-slate-100">
    <nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl dark:border-slate-700/80 dark:bg-slate-900/85">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-1 items-center">
            <a href="<?php echo e(route('home')); ?>" class="group flex items-center gap-2">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 text-xs font-bold text-white shadow-lg shadow-blue-600/30 transition-all duration-300 group-hover:-translate-y-0.5">CR</span>
                <span class="text-sm font-semibold text-slate-900 sm:text-base dark:text-slate-50">Campus Rental</span>
            </a>
        </div>

        <div class="hidden items-center sm:flex">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="flex items-center gap-1 rounded-full bg-slate-50 px-2 py-1 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                    <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Marketplace
                    </a>

                    <a href="<?php echo e(route('my-rentals')); ?>" class="<?php echo e(request()->routeIs('my-rentals') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        My Rentals
                    </a>

                    <a href="<?php echo e(route('my-listings')); ?>" class="<?php echo e(request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        My Listings
                    </a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="hidden flex-1 items-center justify-end gap-3 sm:flex">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('notifications-dropdown');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2136909325-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <?php if (isset($component)) { $__componentOriginalfefe5dbf3b22960644eea9a713073a08 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfefe5dbf3b22960644eea9a713073a08 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dark-mode-toggle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dark-mode-toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfefe5dbf3b22960644eea9a713073a08)): ?>
<?php $attributes = $__attributesOriginalfefe5dbf3b22960644eea9a713073a08; ?>
<?php unset($__attributesOriginalfefe5dbf3b22960644eea9a713073a08); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfefe5dbf3b22960644eea9a713073a08)): ?>
<?php $component = $__componentOriginalfefe5dbf3b22960644eea9a713073a08; ?>
<?php unset($__componentOriginalfefe5dbf3b22960644eea9a713073a08); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="flex items-center gap-2 sm:hidden">
            <?php if (isset($component)) { $__componentOriginalfefe5dbf3b22960644eea9a713073a08 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfefe5dbf3b22960644eea9a713073a08 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dark-mode-toggle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dark-mode-toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfefe5dbf3b22960644eea9a713073a08)): ?>
<?php $attributes = $__attributesOriginalfefe5dbf3b22960644eea9a713073a08; ?>
<?php unset($__attributesOriginalfefe5dbf3b22960644eea9a713073a08); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfefe5dbf3b22960644eea9a713073a08)): ?>
<?php $component = $__componentOriginalfefe5dbf3b22960644eea9a713073a08; ?>
<?php unset($__componentOriginalfefe5dbf3b22960644eea9a713073a08); ?>
<?php endif; ?>
            <button @click="open = !open" class="...">
                </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-slate-200 bg-white px-4 py-3 sm:hidden dark:border-slate-700 dark:bg-slate-900">
        <div class="space-y-2 text-sm">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="space-y-2 rounded-2xl bg-slate-50 p-2 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                    <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        Marketplace
                    </a>
                    <a href="<?php echo e(route('my-rentals')); ?>" class="<?php echo e(request()->routeIs('my-rentals') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        My Rentals
                    </a>
                    <a href="<?php echo e(route('my-listings')); ?>" class="<?php echo e(request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        My Listings
                    </a>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav>

    <section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-violet-700 to-slate-900 text-white">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -left-16 -top-12 h-72 w-72 rounded-full bg-cyan-300/20 blur-3xl"></div>
            <div class="absolute -bottom-20 right-0 h-80 w-80 rounded-full bg-fuchsia-300/20 blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.16),_transparent_45%)]"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-4xl text-center">
                <p class="mb-6 inline-flex rounded-full border border-white/25 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-blue-50 backdrop-blur-xl">
                    Campus Marketplace
                </p>
                <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black tracking-tighter leading-tight mb-6">
                    <span class="block">Share Resources,</span>
                    <span class="block bg-gradient-to-r from-white to-blue-100 dark:to-accent-200 bg-clip-text text-transparent">Save Money</span>
                </h1>

                <p class="mx-auto max-w-2xl text-lg sm:text-xl text-blue-100 dark:text-accent-200 mb-8 leading-relaxed">
                    Rent and lend items within the school campus community. Connect with fellow students, save money, and share resources effortlessly.
                </p>

                <form class="mx-auto mt-10 flex max-w-3xl flex-col gap-3 rounded-2xl border border-white/20 bg-white/95 p-2 shadow-2xl backdrop-blur-xl dark:bg-slate-900/95 sm:flex-row sm:items-center">
                    <div class="flex min-w-0 flex-1 items-center gap-3 px-4">
                        <svg class="h-5 w-5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0Z" />
                        </svg>
                        <input type="text" placeholder="Search for camera, laptop, reviewer, projector..." class="w-full min-w-0 border-0 bg-transparent text-base text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-0 dark:text-slate-100 dark:placeholder:text-slate-500">
                    </div>
                    <button type="button" class="h-12 rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-8 text-base font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5 hover:shadow-xl">
                        Search Items
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="border-b border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-900">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <h2 class="mb-6 text-2xl font-bold text-slate-900 dark:text-slate-50">Browse Categories</h2>
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-center gap-2 rounded-2xl bg-slate-50 p-3 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e($selectedCategory === null ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200 dark:bg-slate-700 dark:text-slate-50 dark:ring-slate-600' : 'text-slate-500 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" /></svg>
                    <span>All</span>
                </a>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('categories.show', $category)); ?>" class="<?php echo e(optional($selectedCategory)->is($category) ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200 dark:bg-slate-700 dark:text-slate-50 dark:ring-slate-600' : 'text-slate-500 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($category->icon === 'book'): ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 17A2.5 2.5 0 0 0 4 19.5m2.5-2.5V5A2 2 0 0 1 8.5 3H20v14M6.5 17H20" /></svg>
                        <?php elseif($category->icon === 'device'): ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z" /></svg>
                        <?php elseif($category->icon === 'pencil'): ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 5 4 4M4 20l4.5-1 9-9a2.121 2.121 0 0 0-3-3l-9 9L4 20Z" /></svg>
                        <?php elseif($category->icon === 'tool'): ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 0 0-5.4 5.87l-5.01 5.02a1.5 1.5 0 1 0 2.12 2.12l5.02-5.01a4 4 0 0 0 5.87-5.4l-2.1 2.1-2.83-.71-.71-2.83 2.1-2.16Z" /></svg>
                        <?php elseif($category->icon === 'fitness'): ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 10V8a1 1 0 0 1 1-1h1v10H7a1 1 0 0 1-1-1v-2m12-4V8a1 1 0 0 0-1-1h-1v10h1a1 1 0 0 0 1-1v-2M8 12h8" /></svg>
                        <?php elseif($category->icon === 'shirt'): ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4.5 5.5 7 3 5.5l2.5-2.5L8 4.5Zm8 0L18.5 7 21 5.5l-2.5-2.5L16 4.5ZM7 7l1-2.5h8L17 7v12a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V7Z" /></svg>
                        <?php else: ?>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.7 2.154a1 1 0 0 0 .95.69h2.264c.969 0 1.371 1.24.588 1.81l-1.832 1.331a1 1 0 0 0-.364 1.118l.7 2.154c.3.921-.755 1.688-1.539 1.118l-1.832-1.331a1 1 0 0 0-1.176 0l-1.832 1.331c-.783.57-1.838-.197-1.539-1.118l.7-2.154a1 1 0 0 0-.364-1.118L5.547 7.58c-.783-.57-.38-1.81.588-1.81H8.4a1 1 0 0 0 .95-.69l.7-2.154Z" /></svg>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span><?php echo e($category->name); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('item-filter');

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2136909325-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</main>

    <?php if (isset($component)) { $__componentOriginal222c87a019257fb1d70ae0ff46ab02e1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal222c87a019257fb1d70ae0ff46ab02e1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.site-footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal222c87a019257fb1d70ae0ff46ab02e1)): ?>
<?php $attributes = $__attributesOriginal222c87a019257fb1d70ae0ff46ab02e1; ?>
<?php unset($__attributesOriginal222c87a019257fb1d70ae0ff46ab02e1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal222c87a019257fb1d70ae0ff46ab02e1)): ?>
<?php $component = $__componentOriginal222c87a019257fb1d70ae0ff46ab02e1; ?>
<?php unset($__componentOriginal222c87a019257fb1d70ae0ff46ab02e1); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\sub\resources\views/livewire/home-page.blade.php ENDPATH**/ ?>