<?php

namespace App\Livewire;

use App\Models\Item;
use App\Notifications\RentalRequestedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ViewItem extends Component
{
    use WithFileUploads;

    public $item;
    public $isEditing = false;
    public $name, $description, $price, $status, $image;
    public $startDate = '';
    public $endDate = '';
    public $additionalNotes = '';

    protected $rules = [
        'name' => 'required|string|min:3',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:available,rented,maintenance',
        'image' => 'nullable|image|max:1024',
    ];

    protected function syncFormFields(): void
    {
        $this->name = $this->item->name;
        $this->description = $this->item->description;
        $this->price = $this->item->price;
        $this->status = $this->item->status;
        $this->image = null;
    }

    public function mount($id)
    {
        $this->item = Item::with('user', 'rentals.renter')->findOrFail($id);
        $this->syncFormFields();
    }

    public function toggleEdit()
    {
        $this->isEditing = ! $this->isEditing;

        if (! $this->isEditing) {
            $this->item->refresh()->load('user', 'rentals.renter');
            $this->syncFormFields();
            $this->resetValidation();
        }
    }

    public function updateItem()
    {
        abort_unless(Auth::check(), 403);

        if ($this->item->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
        ];

        if ($this->image) {
            if ($this->item->image_path) {
                Storage::disk('public')->delete($this->item->image_path);
            }

            $data['image_path'] = $this->image->store('item-photos', 'public');
        }

        $this->item->update($data);
        $this->item->refresh()->load('user', 'rentals.renter');
        $this->syncFormFields();

        session()->flash('message', 'Item updated successfully!');
        $this->isEditing = false;
    }

    public function requestRental(): void
    {
        abort_unless(Auth::check(), 403);

        if ($this->item->user_id === Auth::id()) {
            session()->flash('message', 'You cannot request your own item.');
            return;
        }

        if ($this->item->status !== 'available') {
            session()->flash('message', 'This item is currently unavailable.');
            return;
        }

        $validated = $this->validate([
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate' => ['required', 'date', 'after:startDate'],
            'additionalNotes' => ['nullable', 'string', 'max:500'],
        ]);

        $existingRequest = $this->item->rentals()
            ->where('renter_id', Auth::id())
            ->whereIn('status', ['pending', 'active'])
            ->exists();

        if ($existingRequest) {
            session()->flash('message', 'You already have an active or pending request for this item.');
            return;
        }

        $start = \Carbon\Carbon::parse($validated['startDate']);
        $end = \Carbon\Carbon::parse($validated['endDate']);
        $days = max(1, $start->diffInDays($end));
        $totalPrice = $days * (float) $this->item->price;

        $rental = $this->item->rentals()->create([
            'renter_id' => Auth::id(),
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        $owner = $this->item->user;

        $owner->notify(new RentalRequestedNotification(
            itemId: $this->item->id,
            itemName: $this->item->name,
            renterId: Auth::id(),
            renterName: Auth::user()->name,
            startDate: $start->toDateString(),
            endDate: $end->toDateString(),
            totalPrice: $totalPrice,
            rentalId: $rental->id,
            additionalNotes: trim((string) $this->additionalNotes),
        ));

        $this->reset(['startDate', 'endDate', 'additionalNotes']);
        session()->flash('message', 'Rental request sent successfully!');
    }

    public function render(): mixed
    {
        abort_unless(Auth::check(), 403);

        $isOwner = $this->item->user_id === Auth::id();
        $activeRental = $this->item->rentals->firstWhere('status', 'active');

        return view('livewire.view-item', [
            'isOwner' => $isOwner,
            'activeRental' => $activeRental,
        ]);
    }
}
