<div class="bg-gradient-to-b from-slate-50 via-blue-50/30 to-white py-8 md:py-12 dark:from-slate-950 dark:to-slate-900">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <a href="{{ route('my-listings') }}" class="mb-6 inline-flex items-center text-blue-600 transition-colors hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to My Listings
        </a>
        

        <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-700 dark:bg-slate-900">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-slate-100">Rental Requests</h1>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                        <span class="font-semibold">{{ $item->name }}</span>
                        @if($pendingCount > 0)
                            • {{ $pendingCount }} pending request(s)
                        @endif
                    </p>
                </div>
            </div>
        </div>

        @if($requests->isEmpty())
            <div class="rounded-2xl border border-slate-200 bg-white p-10 text-center shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <p class="text-slate-600 dark:text-slate-400">No rental requests yet for this item.</p>
            </div>
        @else
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[840px]">
                        <thead class="bg-slate-100 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                            <tr>
                                <th class="px-5 py-4 text-left font-semibold">Requester</th>
                                <th class="px-5 py-4 text-left font-semibold">Rental Dates</th>
                                <th class="px-5 py-4 text-left font-semibold">Total</th>
                                <th class="px-5 py-4 text-center font-semibold">Status</th>
                                <th class="px-5 py-4 text-right font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr class="border-t border-slate-200 text-sm text-slate-700 dark:border-slate-700 dark:text-slate-300">
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $request->renter->name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $request->renter->email }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        {{ $request->start_date->format('M d, Y') }} - {{ $request->end_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-5 py-4 font-semibold text-slate-900 dark:text-slate-100">
                                        &#8369;{{ number_format($request->total_price, 2) }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($request->status === 'pending')
                                            <span class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800 dark:bg-amber-900/40 dark:text-amber-200">Pending</span>
                                        @elseif($request->status === 'approved')
                                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800 dark:bg-blue-900/40 dark:text-blue-200">Approved</span>
                                        @elseif($request->status === 'active')
                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200">Active</span>
                                        @elseif($request->status === 'completed')
                                            <span class="inline-flex rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-700 dark:text-slate-200">Completed</span>
                                        @else
                                            <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-800 dark:bg-rose-900/40 dark:text-rose-200">Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('rental-requests.show', $request) }}" class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

