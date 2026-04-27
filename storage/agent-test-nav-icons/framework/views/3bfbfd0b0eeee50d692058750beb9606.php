<div class="bg-gradient-to-b from-gray-50 to-white py-8 md:py-12 dark:from-slate-950 dark:to-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 dark:text-slate-100">My Listings</h1>
                <p class="text-gray-600 dark:text-slate-400">Manage the items you're sharing</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="<?php echo e(route('rent-inventory-management')); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m-9 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-2l-2-2H10L8 5H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Rent Inventory Management
                </a>
                <a href="<?php echo e(route('add-item')); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Item
                </a>
            </div>
        </div>

        <!-- Success Message -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
            <div class="mb-6 p-4 md:p-5 bg-green-50 border border-green-200 text-green-800 rounded-xl shadow-sm dark:bg-green-900/20 dark:border-green-700 dark:text-green-300">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <?php echo e(session('message')); ?>

                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($items->isEmpty()): ?>
            <!-- Empty State -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-12 dark:bg-slate-900 dark:shadow-slate-900/40">
                <div class="text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-slate-100">No items listed yet</h3>
                    <p class="mt-2 text-gray-600 mb-8 dark:text-slate-400">Start sharing resources by creating your first item.</p>
                    <a href="<?php echo e(route('add-item')); ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add First Item
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Items Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow overflow-hidden dark:bg-slate-900 dark:shadow-slate-900/40">
                        <!-- Item Image -->
                        <div class="relative h-48 bg-gray-200 overflow-hidden dark:bg-slate-800">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->name); ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="h-16 w-16 text-gray-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <!-- Status Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    <?php if($item->status === 'available'): ?>
                                        bg-green-100 text-green-800
                                    <?php elseif($item->status === 'rented'): ?>
                                        bg-orange-100 text-orange-800
                                    <?php else: ?>
                                        bg-gray-100 text-gray-800
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($item->status)); ?>

                                </span>
                            </div>

                            <!-- Rental Count Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white text-gray-700 shadow-sm dark:bg-slate-800 dark:text-slate-300">
                                    <?php echo e($item->rentals_count ?? 0); ?> rentals
                                </span>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="p-5">
                            <!-- Item Name -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1 dark:text-slate-100"><?php echo e($item->name); ?></h3>

                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 dark:text-slate-400"><?php echo e($item->description); ?></p>

                            <!-- Price -->
                            <div class="bg-blue-50 rounded-lg p-3 mb-4 dark:bg-slate-800">
                                <p class="text-xs font-medium text-gray-600 mb-1 dark:text-slate-400">Rental Price</p>
                                <p class="text-2xl font-bold text-blue-600">₱<?php echo e(number_format($item->price, 2)); ?></p>
                                <p class="text-xs text-gray-500 dark:text-slate-500">per day</p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->latestRental): ?>
                                    <a
                                        href="<?php echo e(route('rental-requests.show', $item->latestRental)); ?>"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors"
                                    >
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Request
                                    </a>
                                <?php else: ?>
                                    <span class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-slate-300 text-slate-600 text-sm font-semibold rounded-lg cursor-not-allowed">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Request
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <a
                                    href="<?php echo e(route('edit-item', $item->id)); ?>"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold rounded-lg transition-colors"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <button
                                    wire:click="deleteItem(<?php echo e($item->id); ?>)"
                                    wire:confirm="Are you sure you want to delete '<?php echo e($item->name); ?>'? This action cannot be undone."
                                    class="inline-flex items-center justify-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-lg transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($items->hasPages()): ?>
                <div class="mt-8">
                    <?php echo e($items->links()); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\sub\resources\views/livewire/my-listings.blade.php ENDPATH**/ ?>