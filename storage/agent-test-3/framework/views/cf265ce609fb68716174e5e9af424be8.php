<div x-data="{ open: false }" class="relative" wire:poll.30s>
    <button
        type="button"
        @click="open = !open"
        class="relative inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-600 ring-1 ring-slate-200 transition hover:bg-white hover:text-slate-900"
        aria-label="Notifications"
    >
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2a2 2 0 0 1-.6 1.4L4 17h5m6 0v1a3 3 0 1 1-6 0v-1m6 0H9" />
        </svg>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
            <span class="absolute -right-0.5 -top-0.5 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white">
                <?php echo e($unreadCount > 9 ? '9+' : $unreadCount); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </button>

    <div
        x-show="open"
        x-cloak
        @click.outside="open = false"
        class="absolute right-0 z-50 mt-2 w-80 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg"
    >
        <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3">
            <h3 class="text-sm font-semibold text-slate-900">Notifications</h3>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
                <button wire:click="markAllAsRead" class="text-xs font-medium text-[#2850d8] hover:text-[#1f42b5]">
                    Mark all as read
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="max-h-96 overflow-y-auto">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a
                    href="<?php echo e($notification->data['url'] ?? (isset($notification->data['rental_id']) ? route('rental-requests.show', $notification->data['rental_id']) : '#')); ?>"
                    wire:click.prevent="openNotification('<?php echo e($notification->id); ?>')"
                    class="block border-b border-slate-100 px-4 py-3 transition hover:bg-slate-50 <?php echo e(is_null($notification->read_at) ? 'bg-blue-50/50' : ''); ?>"
                >
                    <p class="text-sm font-semibold text-slate-800">
                        <?php echo e($notification->data['title'] ?? 'Notification'); ?>

                    </p>
                    <p class="mt-1 text-xs text-slate-600">
                        <?php echo e($notification->data['message'] ?? ''); ?>

                    </p>
                    <p class="mt-1 text-[11px] text-slate-400">
                        <?php echo e($notification->created_at?->diffForHumans()); ?>

                    </p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-4 py-8 text-center text-sm text-slate-500">
                    No notifications yet.
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\sub\resources\views/livewire/notifications-dropdown.blade.php ENDPATH**/ ?>