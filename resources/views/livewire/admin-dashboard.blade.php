<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Admin Dashboard</h1>
        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
            Platform overview for users, items, and rentals across Campus Rental.
        </p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Users</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($totalUsers) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Verified Students</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($verifiedStudents) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Items</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($totalItems) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Available Items</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($availableItems) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Rentals</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($totalRentals) }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <p class="text-sm text-slate-500 dark:text-slate-400">Active Rentals</p>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($activeRentals) }}</p>
        </div>
    </div>

    <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <p class="text-sm text-slate-500 dark:text-slate-400">Pending Requests</p>
        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ number_format($pendingRentals) }}</p>
    </div>
</div>
