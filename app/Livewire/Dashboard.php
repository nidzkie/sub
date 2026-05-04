<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Rental;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render(): View
    {
        abort_unless(Auth::check(), 403);

        $userId = Auth::id();
        $now = now();

        $ownedItemsQuery = Item::query()->where('user_id', $userId);

        $totalListings = (clone $ownedItemsQuery)->count();
        $availableListings = (clone $ownedItemsQuery)->where('status', 'available')->count();
        $rentedListings = (clone $ownedItemsQuery)->where('status', 'rented')->count();

        $ownedRentalsQuery = Rental::query()
            ->whereHas('item', fn ($query) => $query->where('user_id', $userId));

        $dueSoonRentals = (clone $ownedRentalsQuery)
            ->where('status', Rental::STATUS_ACTIVE)
            ->where('start_date', '<=', $now)
            ->whereBetween('end_date', [$now, $now->copy()->addDays(7)])
            ->count();

        $pendingRequests = (clone $ownedRentalsQuery)
            ->where('status', Rental::STATUS_PENDING)
            ->count();

        $myRentalsQuery = Rental::query()->where('renter_id', $userId);

        $myRentedItemsCount = (clone $myRentalsQuery)
            ->where('status', '!=', Rental::STATUS_CANCELLED)
            ->count();

        $myRentalPendingRequests = (clone $myRentalsQuery)
            ->where('status', Rental::STATUS_PENDING)
            ->count();

        $myRentalOverdueCount = (clone $myRentalsQuery)
            ->where('status', Rental::STATUS_ACTIVE)
            ->where('start_date', '<=', $now)
            ->where('end_date', '<', $now)
            ->count();

        $myRentalDueSoon = (clone $myRentalsQuery)
            ->where('status', Rental::STATUS_ACTIVE)
            ->where('start_date', '<=', $now)
            ->whereBetween('end_date', [$now, $now->copy()->addDays(7)])
            ->count();

        $nonCancelledRentalsQuery = (clone $ownedRentalsQuery)
            ->where('status', '!=', Rental::STATUS_CANCELLED);

        $paidPayments = (clone $nonCancelledRentalsQuery)
            ->where('payment_status', Rental::PAYMENT_STATUS_FULLY_PAID)
            ->count();

        $totalEarnings = (float) (clone $nonCancelledRentalsQuery)->sum('paid_amount');

        $overduePayments = (clone $nonCancelledRentalsQuery)
            ->where('payment_status', '!=', Rental::PAYMENT_STATUS_FULLY_PAID)
            ->whereDate('end_date', '<', $now->toDateString())
            ->count();

        $partialPayments = (clone $nonCancelledRentalsQuery)
            ->where('payment_status', Rental::PAYMENT_STATUS_PARTIAL)
            ->whereDate('end_date', '>=', $now->toDateString())
            ->count();

        $pendingPayments = (clone $nonCancelledRentalsQuery)
            ->where('payment_status', Rental::PAYMENT_STATUS_OUTSTANDING)
            ->whereDate('end_date', '>=', $now->toDateString())
            ->count();

        $recentRentalActivities = (clone $ownedRentalsQuery)
            ->with(['item:id,name,user_id', 'renter:id,name'])
            ->latest('updated_at')
            ->take(8)
            ->get()
            ->toBase()
            ->map(function (Rental $rental): array {
                return [
                    'title' => match ($rental->status) {
                        Rental::STATUS_PENDING => 'New rental request',
                        Rental::STATUS_APPROVED => 'Rental approved',
                        Rental::STATUS_ACTIVE => 'Rental is active',
                        Rental::STATUS_COMPLETED => 'Rental completed',
                        Rental::STATUS_CANCELLED => 'Rental cancelled',
                        default => 'Rental activity updated',
                    },
                    'description' => sprintf(
                        '%s for %s',
                        $rental->renter?->name ?? 'Unknown renter',
                        $rental->item?->name ?? 'Unknown item'
                    ),
                    'at' => $rental->updated_at ?? $rental->created_at,
                    'url' => route('rental-requests.show', $rental),
                ];
            });

        $recentListingActivities = Item::query()
            ->where('user_id', $userId)
            ->latest('created_at')
            ->take(8)
            ->get(['id', 'name', 'created_at'])
            ->toBase()
            ->map(function (Item $item): array {
                return [
                    'title' => 'Item listed',
                    'description' => $item->name,
                    'at' => $item->created_at,
                    'url' => route('item.view', $item->id),
                ];
            });

        /** @var Collection<int, array{title: string, description: string, at: mixed, url: string}> $recentActivities */
        $recentActivities = $recentRentalActivities
            ->merge($recentListingActivities)
            ->sortByDesc('at')
            ->take(8)
            ->values();

        return view('livewire.dashboard', [
            'totalListings' => $totalListings,
            'availableListings' => $availableListings,
            'rentedListings' => $rentedListings,
            'dueSoonRentals' => $dueSoonRentals,
            'pendingRequests' => $pendingRequests,
            'myRentedItemsCount' => $myRentedItemsCount,
            'myRentalPendingRequests' => $myRentalPendingRequests,
            'myRentalOverdueCount' => $myRentalOverdueCount,
            'myRentalDueSoon' => $myRentalDueSoon,
            'pendingPayments' => $pendingPayments,
            'partialPayments' => $partialPayments,
            'paidPayments' => $paidPayments,
            'overduePayments' => $overduePayments,
            'totalEarnings' => $totalEarnings,
            'recentActivities' => $recentActivities,
        ]);
    }
}
