<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl dark:border-slate-700/80 dark:bg-slate-900/85">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-1 items-center">
            <a href="<?php echo e(route('home')); ?>" class="group flex items-center gap-2">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 text-xs font-bold text-white shadow-lg shadow-blue-600/30 transition-all duration-300 group-hover:-translate-y-0.5">CR</span>
                <span class="text-sm font-semibold text-slate-900 sm:text-base dark:text-slate-50">Campus Rental</span>
            </a>
        </div>

        <div class="hidden flex-grow items-center justify-center sm:flex">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="flex items-center gap-2 rounded-full bg-slate-50 px-2 py-1 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
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
                    <a href="<?php echo e(route('my-listings')); ?>" class="<?php echo e(request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') || request()->routeIs('rental-requests.show') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition">
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

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2449454944-0', $__key);

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
                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <button type="button" class="group inline-flex items-center rounded-full px-1 py-1 ring-1 ring-transparent transition hover:ring-slate-200 dark:hover:ring-slate-700">
                            <?php if (isset($component)) { $__componentOriginal32077e48dfcf7eeccbd729b994858fc5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal32077e48dfcf7eeccbd729b994858fc5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-avatar','data' => ['user' => Auth::user(),'showChevron' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()),'showChevron' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal32077e48dfcf7eeccbd729b994858fc5)): ?>
<?php $attributes = $__attributesOriginal32077e48dfcf7eeccbd729b994858fc5; ?>
<?php unset($__attributesOriginal32077e48dfcf7eeccbd729b994858fc5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal32077e48dfcf7eeccbd729b994858fc5)): ?>
<?php $component = $__componentOriginal32077e48dfcf7eeccbd729b994858fc5; ?>
<?php unset($__componentOriginal32077e48dfcf7eeccbd729b994858fc5); ?>
<?php endif; ?>
                        </button>
                     <?php $__env->endSlot(); ?>
                     <?php $__env->slot('content', null, []); ?> 
                        <div class="block px-4 py-2 text-xs text-violet-400">Manage Account</div>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('profile.show')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profile.show')).'']); ?>Profile <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        <div class="border-t border-gray-200 dark:border-slate-700"></div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                            <?php echo csrf_field(); ?>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('logout')).'','@click.prevent' => '$root.submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('logout')).'','@click.prevent' => '$root.submit();']); ?>Log Out <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        </form>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
            <?php else: ?>
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
                <a href="<?php echo e(route('login')); ?>" class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">Sign In</a>
                <a href="<?php echo e(route('register')); ?>" class="rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5 hover:shadow-xl">Sign Up</a>
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
            <button @click="open = !open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-slate-200 bg-white px-4 py-3 sm:hidden dark:border-slate-700 dark:bg-slate-900">
        <div class="space-y-2 text-sm">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="space-y-2 rounded-2xl bg-slate-50 p-2 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                    <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Marketplace
                    </a>
                    <a href="<?php echo e(route('my-rentals')); ?>" class="<?php echo e(request()->routeIs('my-rentals') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        My Rentals
                    </a>
                    <a href="<?php echo e(route('my-listings')); ?>" class="<?php echo e(request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') || request()->routeIs('rental-requests.show') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100'); ?> flex items-center gap-3 rounded-xl px-4 py-3 font-semibold transition">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        My Listings
                    </a>
                </div>
                <a href="<?php echo e(route('profile.show')); ?>" class="flex items-center gap-3 px-1 pt-2 text-slate-600 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">
                    <?php if (isset($component)) { $__componentOriginal32077e48dfcf7eeccbd729b994858fc5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal32077e48dfcf7eeccbd729b994858fc5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.profile-avatar','data' => ['user' => Auth::user(),'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('profile-avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()),'size' => 'md']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal32077e48dfcf7eeccbd729b994858fc5)): ?>
<?php $attributes = $__attributesOriginal32077e48dfcf7eeccbd729b994858fc5; ?>
<?php unset($__attributesOriginal32077e48dfcf7eeccbd729b994858fc5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal32077e48dfcf7eeccbd729b994858fc5)): ?>
<?php $component = $__componentOriginal32077e48dfcf7eeccbd729b994858fc5; ?>
<?php unset($__componentOriginal32077e48dfcf7eeccbd729b994858fc5); ?>
<?php endif; ?>
                    <span class="font-medium">Profile</span>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="block py-2 font-medium text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">Sign In</a>
                <a href="<?php echo e(route('register')); ?>" class="block rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-2 text-center font-semibold text-white">Sign Up</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\sub\resources\views/navigation-menu.blade.php ENDPATH**/ ?>