<?php

namespace App\Livewire;

use App\Models\Rental;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class RentInventoryManagement extends Component
{
    use WithPagination;

    public string $search = '';

    public string $filterStatus = 'all';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function setFilter(string $status): void
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function approveRequest(int $rentalId): void
    {
        abort_unless(Auth::check(), 403);

        $rental = Rental::query()
            ->whereHas('item', fn ($query) => $query->where('user_id', Auth::id()))
            ->where('status', 'pending')
            ->findOrFail($rentalId);

        $rental->update(['status' => 'active']);
        $rental->item->update(['status' => 'rented']);

        session()->flash('message', 'Rental request approved.');
    }

    public function rejectRequest(int $rentalId): void
    {
        abort_unless(Auth::check(), 403);

        $rental = Rental::query()
            ->whereHas('item', fn ($query) => $query->where('user_id', Auth::id()))
            ->where('status', 'pending')
            ->findOrFail($rentalId);

        $rental->update(['status' => 'cancelled']);

        session()->flash('message', 'Rental request rejected.');
    }

    public function updatePaymentStatus(int $rentalId, string $status): void
    {
        abort_unless(Auth::check(), 403);

        if (! in_array($status, ['outstanding', 'partial', 'fully_paid'], true)) {
            return;
        }

        $rental = Rental::query()
            ->whereHas('item', fn ($query) => $query->where('user_id', Auth::id()))
            ->findOrFail($rentalId);

        $rental->update(['payment_status' => $status]);
    }

    public function render(): View
    {
        abort_unless(Auth::check(), 403);

        $baseQuery = Rental::query()
            ->whereHas('item', fn ($query) => $query->where('user_id', Auth::id()))
            ->whereIn('status', ['pending', 'active'])
            ->with(['item.categoryRecord', 'renter']);

        if ($this->search !== '') {
            $search = '%'.trim($this->search).'%';
            $baseQuery->where(function ($query) use ($search): void {
                $query->whereHas('item', fn ($itemQuery) => $itemQuery->where('name', 'like', $search))
                    ->orWhereHas('renter', fn ($renterQuery) => $renterQuery->where('name', 'like', $search));
            });
        }

        $allCount = (clone $baseQuery)->count();
        $dueSoonCount = (clone $baseQuery)
            ->where('status', 'active')
            ->whereBetween('end_date', [now(), now()->addDays(7)])
            ->count();
        $activeCount = (clone $baseQuery)->where('status', 'active')->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();

        $rentalsQuery = clone $baseQuery;

        if ($this->filterStatus === 'due_soon') {
            $rentalsQuery->where('status', 'active')
                ->whereBetween('end_date', [now(), now()->addDays(7)]);
        } elseif ($this->filterStatus === 'active') {
            $rentalsQuery->where('status', 'active');
        } elseif ($this->filterStatus === 'pending') {
            $rentalsQuery->where('status', 'pending');
        }

        $rentals = $rentalsQuery
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('end_date')
            ->paginate(10);

        return view('livewire.rent-inventory-management', [
            'rentals' => $rentals,
            'allCount' => $allCount,
            'dueSoonCount' => $dueSoonCount,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
        ]);
    }
}
