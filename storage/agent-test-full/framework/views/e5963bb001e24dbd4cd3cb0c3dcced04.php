<div class="bg-gradient-to-b from-slate-50 via-blue-50/30 to-white py-8 md:py-12">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">View Request</h1>
                <p class="text-sm text-slate-600">Review requester details and decide to grant or reject.</p>
            </div>
            <a href="<?php echo e(route('rent-inventory-management')); ?>" class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                Back to Rent Inventory
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
            <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dueTomorrow): ?>
            <div class="mb-6 rounded-xl border border-amber-300 bg-amber-50 p-4 text-sm text-amber-900">
                <span class="font-semibold">Due soon:</span> This rental is due in <?php echo e($daysLeft); ?> day.
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900">Request Information</h2>
                    <dl class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Item</dt>
                            <dd class="mt-2 text-sm font-semibold text-slate-900"><?php echo e($rental->item->name); ?></dd>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Rental Status</dt>
                            <dd class="mt-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rental->status === 'pending'): ?>
                                    <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">Pending Request</span>
                                <?php elseif($rental->status === 'approved'): ?>
                                    <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">On Process</span>
                                <?php elseif($rental->status === 'active'): ?>
                                    <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">Active Loan</span>
                                <?php else: ?>
                                    <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-800">Rejected</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </dd>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Start Date</dt>
                            <dd class="mt-2 text-sm font-semibold text-slate-900"><?php echo e($rental->start_date->format('M d, Y')); ?></dd>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">End Date</dt>
                            <dd class="mt-2 text-sm font-semibold text-slate-900"><?php echo e($rental->end_date->format('M d, Y')); ?></dd>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Days Requested</dt>
                            <dd class="mt-2 text-sm font-semibold text-slate-900"><?php echo e($daysRequested); ?> day(s)</dd>
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                            <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total Amount</dt>
                            <dd class="mt-2 text-sm font-semibold text-slate-900">&#8369;<?php echo e(number_format($rental->total_price, 2)); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900">Requester</h2>
                    <div class="mt-4 space-y-3 text-sm">
                        <p><span class="font-semibold text-slate-700">Name:</span> <span class="text-slate-900"><?php echo e($rental->renter->name); ?></span></p>
                        <p><span class="font-semibold text-slate-700">Email:</span> <span class="text-slate-900"><?php echo e($rental->renter->email); ?></span></p>
                        <p><span class="font-semibold text-slate-700">Phone:</span> <span class="text-slate-900"><?php echo e($rental->renter->phone_number ?: 'Not provided'); ?></span></p>
                        <p><span class="font-semibold text-slate-700">Course:</span> <span class="text-slate-900"><?php echo e($rental->renter->course ?: 'Not provided'); ?></span></p>
                        <p><span class="font-semibold text-slate-700">Year Level:</span> <span class="text-slate-900"><?php echo e($rental->renter->year_level ?: 'Not provided'); ?></span></p>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900">Decision</h2>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rental->status === 'pending'): ?>
                        <div class="mt-4 grid gap-3">
                            <button wire:click="grantRequest" class="rounded-lg bg-gradient-to-r from-emerald-600 to-green-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:shadow-md">
                                Grant Request
                            </button>
                            <button wire:click="rejectRequest" class="rounded-lg bg-gradient-to-r from-rose-600 to-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:shadow-md">
                                Reject Request
                            </button>
                        </div>
                    <?php else: ?>
                        <p class="mt-3 text-sm text-slate-600">Request already processed. The requester has been notified automatically.</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\sub\resources\views/livewire/owner-rental-request-view.blade.php ENDPATH**/ ?>