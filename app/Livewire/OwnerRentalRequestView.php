<?php

namespace App\Livewire;

use App\Models\Rental;
use App\Notifications\RentalRequestDecisionNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class OwnerRentalRequestView extends Component
{
    public Rental $rental;

    public bool $isOwner = false;

    public function mount(Rental $rental): void
    {
        abort_unless(Auth::check(), 403);

        $this->rental = Rental::query()
            ->whereKey($rental->id)
            ->with(['item.user', 'renter'])
            ->firstOrFail();

        $this->isOwner = (int) $this->rental->item->user_id === (int) Auth::id();
        $isRenter = (int) $this->rental->renter_id === (int) Auth::id();

        abort_unless($this->isOwner || $isRenter, 403);
    }

    public function grantRequest(): void
    {
        abort_unless(Auth::check(), 403);
        abort_unless($this->isOwner, 403);

        if ($this->rental->status !== 'pending') {
            return;
        }

        $this->rental->update([
            'status' => Rental::STATUS_APPROVED,
            'approved_at' => now(),
            'cancelled_at' => null,
        ]);
        $this->rental->renter->notify(new RentalRequestDecisionNotification(
            rentalId: $this->rental->id,
            itemId: $this->rental->item->id,
            itemName: $this->rental->item->name,
            decision: 'approved',
        ));

        $this->rental->refresh();
        session()->flash('message', 'Rental request granted.');
    }

    public function rejectRequest(): void
    {
        abort_unless(Auth::check(), 403);
        abort_unless($this->isOwner, 403);

        if ($this->rental->status !== 'pending') {
            return;
        }

        $this->rental->update([
            'status' => Rental::STATUS_CANCELLED,
            'cancelled_at' => now(),
        ]);
        $this->rental->renter->notify(new RentalRequestDecisionNotification(
            rentalId: $this->rental->id,
            itemId: $this->rental->item->id,
            itemName: $this->rental->item->name,
            decision: 'rejected',
        ));

        $this->rental->refresh();
        session()->flash('message', 'Rental request rejected.');
    }

    public function render(): View
    {
        $secondsLeft = now()->diffInSeconds($this->rental->end_date, false);
        $daysLeft = $secondsLeft >= 0
            ? (int) ceil($secondsLeft / 86400)
            : (int) floor($secondsLeft / 86400);
        $secondsRequested = $this->rental->start_date->diffInSeconds($this->rental->end_date, false);
        $daysRequested = max(1, (int) ceil($secondsRequested / 86400));

        return view('livewire.owner-rental-request-view', [
            'daysRequested' => $daysRequested,
            'daysLeft' => max(0, $daysLeft),
            'dueTomorrow' => $this->rental->status === 'active' && $daysLeft === 1,
            'isOwner' => $this->isOwner,
        ]);
    }
}
