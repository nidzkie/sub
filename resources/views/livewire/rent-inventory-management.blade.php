<div class="bg-gradient-to-b from-slate-50 via-blue-50/40 to-violet-50/30 py-8 md:py-12 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative mb-8 overflow-hidden rounded-2xl border border-white/50 bg-gradient-to-br from-blue-600 via-indigo-600 to-violet-600 p-6 text-white shadow-xl shadow-indigo-900/20 md:p-8">
            <div class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full bg-white/10 blur-2xl"></div>
            <div class="pointer-events-none absolute -bottom-12 -left-12 h-40 w-40 rounded-full bg-cyan-300/20 blur-2xl"></div>

            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="mb-2 text-3xl font-black tracking-tight md:text-4xl">Rent Inventory Management</h1>
                    <p class="text-blue-100">Monitor and manage all rental transactions tied to your listed items.</p>
                </div>
                <a href="{{ route('my-listings') }}" class="inline-flex items-center justify-center rounded-lg border border-white/30 bg-white/15 px-4 py-2.5 font-semibold text-white backdrop-blur-sm transition hover:bg-white/25">
                    Back to My Listings
                </a>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="mb-6 rounded-xl border border-emerald-200/80 bg-emerald-50/90 p-4 text-emerald-900 shadow-sm backdrop-blur-sm dark:border-emerald-900/60 dark:bg-emerald-900/20 dark:text-emerald-200">
                <div class="flex items-start gap-2">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('message') }}</span>
                </div>
            </div>
        @endif

        @if ($pendingCount > 0 || $dueSoonCount > 0)
            <div class="mb-6 grid gap-3 sm:grid-cols-2">
                @if ($pendingCount > 0)
                    <div class="rounded-xl border border-amber-200/80 bg-amber-50/90 p-4 text-amber-900 shadow-sm backdrop-blur-sm dark:border-amber-900/60 dark:bg-amber-900/20 dark:text-amber-200">
                        <p class="text-sm font-semibold">Pending Requests</p>
                        <p class="mt-1 text-sm">You have <span class="font-bold">{{ $pendingCount }}</span> request(s) waiting for approval.</p>
                    </div>
                @endif
                @if ($dueSoonCount > 0)
                    <div class="rounded-xl border border-rose-200/80 bg-rose-50/90 p-4 text-rose-900 shadow-sm backdrop-blur-sm dark:border-rose-900/60 dark:bg-rose-900/20 dark:text-rose-200">
                        <p class="text-sm font-semibold">Due Soon Alert</p>
                        <p class="mt-1 text-sm"><span class="font-bold">{{ $dueSoonCount }}</span> active loan(s) are nearing return date.</p>
                    </div>
                @endif
            </div>
        @endif

        <div class="mb-6 rounded-2xl border border-slate-200/70 bg-white/75 p-4 shadow-lg shadow-slate-900/5 backdrop-blur-xl dark:border-slate-700/70 dark:bg-slate-900/70 md:p-5">
            <div class="mb-4">
                <label for="search" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Search Item or Borrower</label>
                <div class="relative">
                    <svg class="pointer-events-none absolute left-3 top-3.5 h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input id="search" type="text" wire:model.live.debounce.300ms="search" placeholder="Search by item name or borrower name..." class="w-full rounded-lg border border-slate-300 bg-white/80 py-3 pl-10 pr-4 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <button wire:click="setFilter('all')" class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold transition {{ $filterStatus === 'all' ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-md' : 'border border-slate-300 bg-white text-slate-700 hover:border-blue-400 hover:text-blue-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300' }}">
                    All Listings <span class="ml-2 rounded-full bg-black/10 px-2 py-0.5 text-xs">{{ $allCount }}</span>
                </button>
                <button wire:click="setFilter('due_soon')" class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold transition {{ $filterStatus === 'due_soon' ? 'bg-gradient-to-r from-rose-600 to-red-600 text-white shadow-md' : 'border border-slate-300 bg-white text-slate-700 hover:border-rose-400 hover:text-rose-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300' }}">
                    Due Soon <span class="ml-2 rounded-full bg-black/10 px-2 py-0.5 text-xs">{{ $dueSoonCount }}</span>
                </button>
                <button wire:click="setFilter('active')" class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold transition {{ $filterStatus === 'active' ? 'bg-gradient-to-r from-emerald-600 to-green-600 text-white shadow-md' : 'border border-slate-300 bg-white text-slate-700 hover:border-emerald-400 hover:text-emerald-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300' }}">
                    Active Loan <span class="ml-2 rounded-full bg-black/10 px-2 py-0.5 text-xs">{{ $activeCount }}</span>
                </button>
                <button wire:click="setFilter('pending')" class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold transition {{ $filterStatus === 'pending' ? 'bg-gradient-to-r from-amber-600 to-orange-600 text-white shadow-md' : 'border border-slate-300 bg-white text-slate-700 hover:border-amber-400 hover:text-amber-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300' }}">
                    Pending Request <span class="ml-2 rounded-full bg-black/10 px-2 py-0.5 text-xs">{{ $pendingCount }}</span>
                </button>
            </div>
        </div>

        @if ($rentals->isEmpty())
            <div class="rounded-2xl border border-slate-200/70 bg-white/80 p-10 text-center shadow-sm backdrop-blur-xl dark:border-slate-700/70 dark:bg-slate-900/70 md:p-14">
                <svg class="mx-auto mb-4 h-14 w-14 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mb-2 text-xl font-semibold text-slate-900 dark:text-slate-100">No records found</h3>
                <p class="text-slate-600 dark:text-slate-400">Try another filter or search keyword to find a rental transaction.</p>
            </div>
        @else
            <div class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/80 shadow-lg shadow-slate-900/5 backdrop-blur-xl dark:border-slate-700/70 dark:bg-slate-900/70">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[980px]">
                        <thead>
                            <tr class="bg-slate-100/90 text-sm text-slate-700 dark:bg-slate-800/90 dark:text-slate-300">
                                <th class="px-5 py-4 text-left font-semibold">Item</th>
                                <th class="px-5 py-4 text-left font-semibold">Borrower</th>
                                <th class="px-5 py-4 text-left font-semibold">Price/Day</th>
                                <th class="px-5 py-4 text-left font-semibold">Start Date</th>
                                <th class="px-5 py-4 text-left font-semibold">End Date</th>
                                <th class="px-5 py-4 text-center font-semibold">Days</th>
                                <th class="px-5 py-4 text-right font-semibold">Total Cost</th>
                                <th class="px-5 py-4 text-center font-semibold">Payment Status</th>
                                <th class="px-5 py-4 text-center font-semibold">Rental Status</th>
                                <th class="px-5 py-4 text-center font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rental)
                                @php
                                    $days = max(1, $rental->start_date->diffInDays($rental->end_date));
                                    $dueSoon = $rental->status === 'active' && now()->between($rental->start_date, $rental->end_date) && now()->diffInDays($rental->end_date, false) <= 7;
                                @endphp
                                <tr class="border-t border-slate-200 text-sm text-slate-700 dark:border-slate-700 dark:text-slate-300">
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-slate-900 dark:text-slate-100">{{ $rental->item->name }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $rental->item->categoryRecord?->name ?? 'No category' }}</div>
                                    </td>
                                    <td class="px-5 py-4">{{ $rental->renter->name }}</td>
                                    <td class="px-5 py-4">&#8369;{{ number_format($rental->item->price, 2) }}</td>
                                    <td class="px-5 py-4">{{ $rental->start_date->format('M d, Y') }}</td>
                                    <td class="px-5 py-4">{{ $rental->end_date->format('M d, Y') }}</td>
                                    <td class="px-5 py-4 text-center">{{ $days }}</td>
                                    <td class="px-5 py-4 text-right font-semibold text-slate-900 dark:text-slate-100">&#8369;{{ number_format($rental->total_price, 2) }}</td>
                                    <td class="px-5 py-4 text-center">
                                        <select wire:change="updatePaymentStatus({{ $rental->id }}, $event.target.value)" class="rounded-lg border border-slate-300 bg-white px-2 py-1.5 text-xs font-semibold focus:border-blue-500 focus:outline-none dark:border-slate-700 dark:bg-slate-900" @disabled($rental->status === 'cancelled')>
                                            <option value="outstanding" @selected($rental->payment_status === 'outstanding')>Outstanding</option>
                                            <option value="partial" @selected($rental->payment_status === 'partial')>Partial</option>
                                            <option value="fully_paid" @selected($rental->payment_status === 'fully_paid')>Fully Paid</option>
                                        </select>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if ($rental->status === 'pending')
                                            <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800 dark:bg-amber-900/40 dark:text-amber-200">Pending</span>
                                        @elseif ($dueSoon)
                                            <span class="inline-flex items-center rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-800 dark:bg-rose-900/40 dark:text-rose-200">Due Soon</span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Active Loan</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if ($rental->status === 'pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <button wire:click="approveRequest({{ $rental->id }})" class="rounded-md bg-gradient-to-r from-emerald-600 to-green-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:shadow-md">
                                                    Approve
                                                </button>
                                                <button wire:click="rejectRequest({{ $rental->id }})" class="rounded-md bg-gradient-to-r from-rose-600 to-red-600 px-3 py-1.5 text-xs font-semibold text-white transition hover:shadow-md">
                                                    Reject
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-500 dark:text-slate-400">No action</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($rentals->hasPages())
                <div class="mt-6">
                    {{ $rentals->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
