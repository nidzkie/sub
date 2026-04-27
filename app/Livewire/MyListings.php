<?php

namespace App\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class MyListings extends Component
{
    use WithPagination;

    public function deleteItem($itemId)
    {
        abort_unless(Auth::check(), 403);

        $item = Item::where('user_id', Auth::id())->findOrFail($itemId);

        $item->delete();

        $this->resetPage();

        session()->flash('message', 'Item deleted successfully.');
    }

    public function render()
    {
        abort_unless(Auth::check(), 403);

        $items = Item::where('user_id', Auth::id())
            ->with('latestRental')
            ->withCount('rentals')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.my-listings', [
            'items' => $items,
        ]);
    }
}
