<div class="bg-gradient-to-b from-gray-50 to-white py-8 md:py-12 dark:from-slate-950 dark:to-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
            <div class="space-y-2">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-slate-100">Dashboard</h1>
                <p class="text-slate-600 dark:text-slate-400">Track your listings, requests, and rental activity in one place.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('rent-inventory-management') }}" class="inline-flex items-center justify-center px-6 py-3 bg-violet-600 hover:bg-violet-700 text-white font-semibold rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m-9 4h12a2 2 0 002-2V7a2 2 0 00-2-2h-2l-2-2H10L8 5H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Rent Inventory Management
                </a>
                <a href="{{ route('add-item') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Item
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-base font-semibold text-slate-900 dark:text-slate-100">My Listings</h2>
                    <a href="{{ route('rent-inventory-management') }}" class="text-xs font-semibold text-blue-700 transition hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-200">
                        Manage Inventory
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Total Listings</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $totalListings }}</p>
                        <div class="mt-3 flex flex-wrap gap-2 text-xs">
                            <span class="inline-flex min-w-28 items-center justify-center rounded-full bg-green-100 px-3 py-1 font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                {{ $availableListings }} available
                            </span>
                            <span class="inline-flex min-w-24 items-center justify-center rounded-full bg-orange-100 px-3 py-1 font-medium text-orange-800 dark:bg-orange-900/30 dark:text-orange-300">
                                {{ $rentedListings }} rented
                            </span>
                        </div>
                    </div>

                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Pending Requests</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $pendingRequests }}</p>
                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-400">Rental requests waiting for your decision.</p>
                    </div>

                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Due Soon</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $dueSoonRentals }}</p>
                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-400">Items due soon in the next 7 days.</p>
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-base font-semibold text-slate-900 dark:text-slate-100">My Rentals</h2>
                    <a href="{{ route('my-rentals') }}" class="text-xs font-semibold text-blue-700 transition hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-200">
                        View My Rentals
                    </a>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">All Items I've Rented</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $myRentedItemsCount }}</p>
                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-400">All your non-cancelled rental records.</p>
                    </div>

                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Overdue</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $myRentalOverdueCount }}</p>
                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-400">Items you still need to return past due date.</p>
                    </div>

                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-4 dark:border-slate-700 dark:bg-slate-800/50">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Due Soon</p>
                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $myRentalDueSoon }}</p>
                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-400">Items due soon in the next 7 days.</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Payments Overview</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">My Listings</p>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 dark:border-amber-800/50 dark:bg-amber-900/20">
                        <p class="text-xs font-medium text-amber-700 dark:text-amber-300">Pending</p>
                        <p class="mt-1 text-2xl font-bold text-amber-900 dark:text-amber-200">{{ $pendingPayments }}</p>
                    </div>

                    <div class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 dark:border-blue-800/50 dark:bg-blue-900/20">
                        <p class="text-xs font-medium text-blue-700 dark:text-blue-300">Partial</p>
                        <p class="mt-1 text-2xl font-bold text-blue-900 dark:text-blue-200">{{ $partialPayments }}</p>
                    </div>

                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 dark:border-emerald-800/50 dark:bg-emerald-900/20">
                        <p class="text-xs font-medium text-emerald-700 dark:text-emerald-300">Paid</p>
                        <p class="mt-1 text-2xl font-bold text-emerald-900 dark:text-emerald-200">{{ $paidPayments }}</p>
                    </div>

                    <div class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 dark:border-rose-800/50 dark:bg-rose-900/20">
                        <p class="text-xs font-medium text-rose-700 dark:text-rose-300">Overdue</p>
                        <p class="mt-1 text-2xl font-bold text-rose-900 dark:text-rose-200">{{ $overduePayments }}</p>
                    </div>
                </div>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-slate-400">Payments Overview</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">My Rentals</p>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3">
                    <div class="rounded-lg border border-amber-200 bg-amber-50 px-3 py-2 dark:border-amber-800/50 dark:bg-amber-900/20">
                        <p class="text-xs font-medium text-amber-700 dark:text-amber-300">Pending</p>
                        <p class="mt-1 text-2xl font-bold text-amber-900 dark:text-amber-200">{{ $pendingPayments }}</p>
                    </div>

                    <div class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-2 dark:border-blue-800/50 dark:bg-blue-900/20">
                        <p class="text-xs font-medium text-blue-700 dark:text-blue-300">Partial</p>
                        <p class="mt-1 text-2xl font-bold text-blue-900 dark:text-blue-200">{{ $partialPayments }}</p>
                    </div>

                    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 dark:border-emerald-800/50 dark:bg-emerald-900/20">
                        <p class="text-xs font-medium text-emerald-700 dark:text-emerald-300">Paid</p>
                        <p class="mt-1 text-2xl font-bold text-emerald-900 dark:text-emerald-200">{{ $paidPayments }}</p>
                    </div>

                    <div class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-2 dark:border-rose-800/50 dark:bg-rose-900/20">
                        <p class="text-xs font-medium text-rose-700 dark:text-rose-300">Overdue</p>
                        <p class="mt-1 text-2xl font-bold text-rose-900 dark:text-rose-200">{{ $overduePayments }}</p>
                    </div>
                </div>
            </section>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <section class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Recent Activity</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">My Listings</p>
                </div>

                <ul class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse ($recentActivities as $activity)
                        <li class="px-5 py-4">
                            <a href="{{ $activity['url'] }}" class="block group">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700 dark:text-slate-100 dark:group-hover:text-blue-300">
                                            {{ $activity['title'] }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $activity['description'] }}</p>
                                    </div>
                                    <span class="shrink-0 text-xs text-slate-500 dark:text-slate-400">{{ $activity['at']->diffForHumans() }}</span>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-5 py-8 text-sm text-slate-600 dark:text-slate-400">No recent listing activity yet.</li>
                    @endforelse
                </ul>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4 dark:border-slate-700">
                    <h2 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Recent Activity</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">My Rentals</p>
                </div>

                <ul class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse ($recentActivities as $activity)
                        <li class="px-5 py-4">
                            <a href="{{ $activity['url'] }}" class="block group">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-700 dark:text-slate-100 dark:group-hover:text-blue-300">
                                            {{ $activity['title'] }}
                                        </p>
                                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">{{ $activity['description'] }}</p>
                                    </div>
                                    <span class="shrink-0 text-xs text-slate-500 dark:text-slate-400">{{ $activity['at']->diffForHumans() }}</span>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-5 py-8 text-sm text-slate-600 dark:text-slate-400">No recent rental activity yet.</li>
                    @endforelse
                </ul>
            </section>
        </div>
    </div>
</div>
