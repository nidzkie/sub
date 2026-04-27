<?php

namespace App\Livewire;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class MyRentals extends Component
{
    use WithPagination;

    public $filterStatus = 'all';

    public function setFilter($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function render()
    {
        abort_unless(Auth::check(), 403);

        $query = Rental::where('renter_id', Auth::id())
            ->with('item.user');

        // Apply filters
        if ($this->filterStatus !== 'all') {
            if ($this->filterStatus === 'pending') {
                $query->where(function ($subQuery): void {
                    $subQuery->whereIn('status', ['pending', 'approved'])
                        ->orWhere(function ($activeFutureQuery): void {
                            $activeFutureQuery->where('status', 'active')
                                ->where('start_date', '>', now());
                        });
                });
            } elseif ($this->filterStatus === 'due_soon') {
                $query->where('status', 'active')
                    ->where('start_date', '<=', now())
                    ->whereBetween('end_date', [now(), now()->addDays(7)]);
            } elseif ($this->filterStatus === 'ongoing') {
                $query->where('status', 'active')
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>', now()->addDays(7));
            }
        }

        $rentals = $query->orderBy('end_date', 'asc')
            ->paginate(15);

        return view('livewire.my-rentals', [
            'rentals' => $rentals,
        ]);
    }
}
