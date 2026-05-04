<div class="bg-slate-50 py-8 text-slate-950 dark:bg-slate-950 dark:text-slate-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="space-y-2">
            <h1 class="text-4xl font-extrabold tracking-normal text-slate-950 dark:text-white">Dashboard</h1>
            <p class="text-lg text-slate-600 dark:text-slate-300">Welcome back! Here's your rental overview.</p>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 8-9-5-9 5m18 0-9 5m9-5v8l-9 5m0-8L3 8m9 5v8M3 8v8l9 5" />
                    </svg>
                </div>
                <p class="mt-6 text-3xl font-extrabold text-slate-950 dark:text-white">{{ $myRentedItemsCount }}</p>
                <p class="mt-2 text-base text-slate-600 dark:text-slate-300">Active Rentals</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-300">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17l6-6 4 4 8-8m0 0v6m0-6h-6" />
                    </svg>
                </div>
                <p class="mt-6 text-3xl font-extrabold text-slate-950 dark:text-white">{{ $availableListings }}</p>
                <p class="mt-2 text-base text-slate-600 dark:text-slate-300">Active Listings</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-yellow-100 text-amber-600 dark:bg-amber-500/15 dark:text-amber-300">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <p class="mt-6 text-3xl font-extrabold text-slate-950 dark:text-white">{{ $pendingRequests }}</p>
                <p class="mt-2 text-base text-slate-600 dark:text-slate-300">Pending Requests</p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="inline-flex h-14 w-14 items-center justify-center rounded-xl bg-purple-100 text-purple-600 dark:bg-purple-500/15 dark:text-purple-300">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m4.5-14.5H10a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6H6.5" />
                    </svg>
                </div>
                <p class="mt-6 text-3xl font-extrabold text-slate-950 dark:text-white">₱{{ number_format($totalEarnings, 0) }}</p>
                <p class="mt-2 text-base text-slate-600 dark:text-slate-300">Total Earnings</p>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 xl:grid-cols-2">
            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-2xl font-extrabold text-slate-950 dark:text-white">Recent Activity</h2>

                <div class="mt-6 space-y-4">
                    @forelse ($recentActivities->take(2) as $activity)
                        <a href="{{ $activity['url'] }}" class="group flex items-center gap-5 rounded-xl bg-slate-50 p-5 transition hover:bg-slate-100 dark:bg-slate-800/70 dark:hover:bg-slate-800">
                            <span class="inline-flex h-12 w-12 shrink-0 items-center justify-center rounded-xl {{ $loop->first ? 'bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-300' : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-300' }}">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 8-9-5-9 5m18 0-9 5m9-5v8l-9 5m0-8L3 8m9 5v8M3 8v8l9 5" />
                                </svg>
                            </span>
                            <span class="min-w-0">
                                <span class="block truncate text-lg font-bold text-slate-950 group-hover:text-blue-700 dark:text-white dark:group-hover:text-blue-300">{{ $activity['description'] }}</span>
                                <span class="mt-2 flex flex-wrap items-center gap-3">
                                    <span class="rounded-full {{ str_contains(strtolower($activity['title']), 'request') ? 'bg-yellow-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-300' }} px-3 py-1 text-sm">{{ str_contains(strtolower($activity['title']), 'request') ? 'pending' : 'active' }}</span>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">{{ $activity['at']->toDateString() }}</span>
                                </span>
                            </span>
                        </a>
                    @empty
                        <div class="rounded-xl bg-slate-50 p-5 text-base text-slate-600 dark:bg-slate-800/70 dark:text-slate-300">
                            No recent activity yet.
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h2 class="text-2xl font-extrabold text-slate-950 dark:text-white">Quick Actions</h2>

                <div class="mt-6 space-y-4">
                    <a href="{{ route('home') }}" class="block rounded-xl border border-blue-200 bg-blue-50 px-5 py-5 transition hover:border-blue-300 hover:bg-blue-100 dark:border-blue-800/60 dark:bg-blue-950/40 dark:hover:bg-blue-950/70">
                        <span class="block text-xl font-bold text-blue-800 dark:text-blue-300">Browse Marketplace</span>
                        <span class="mt-2 block text-base text-blue-700 dark:text-blue-200">Find items to rent from other students</span>
                    </a>

                    <a href="{{ route('add-item') }}" class="block rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-5 transition hover:border-emerald-300 hover:bg-emerald-100 dark:border-emerald-800/60 dark:bg-emerald-950/40 dark:hover:bg-emerald-950/70">
                        <span class="block text-xl font-bold text-emerald-950 dark:text-emerald-200">List an Item</span>
                        <span class="mt-2 block text-base text-emerald-700 dark:text-emerald-300">Share your items and earn money</span>
                    </a>

                    <a href="{{ route('my-rentals') }}" class="block rounded-xl border border-purple-200 bg-purple-50 px-5 py-5 transition hover:border-purple-300 hover:bg-purple-100 dark:border-purple-800/60 dark:bg-purple-950/40 dark:hover:bg-purple-950/70">
                        <span class="block text-xl font-bold text-purple-800 dark:text-purple-300">View My Rentals</span>
                        <span class="mt-2 block text-base text-purple-700 dark:text-purple-200">Track your borrowed items</span>
                    </a>
                </div>
            </section>
        </div>
    </div>
</div>
