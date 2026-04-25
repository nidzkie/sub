<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;

class ItemFilter extends Component
{
    public string $search = '';

    public string $category = '';

    public string $maxPrice = '';

    public string $sortBy = 'latest';

    public function resetFilters(): void
    {
        $this->search = '';
        $this->category = '';
        $this->maxPrice = '';
        $this->sortBy = 'latest';
    }

    public function render()
    {
        $items = Item::query()
            ->with(['categoryRecord', 'user'])
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%'.$this->search.'%'))
            ->when($this->category, fn ($q) => $q->where('category_id', $this->category))
            ->when($this->maxPrice, function ($q) {
                return match ($this->maxPrice) {
                    'under_50' => $q->where('price', '<', 50),
                    'under_100' => $q->where('price', '<', 100),
                    'under_200' => $q->where('price', '<', 200),
                    'under_500' => $q->where('price', '<', 500),
                    default => $q
                };
            })
            ->when($this->sortBy, function ($q) {
                return match ($this->sortBy) {
                    'latest' => $q->latest(),
                    'oldest' => $q->oldest(),
                    'price_asc' => $q->orderBy('price', 'asc'),
                    'price_desc' => $q->orderBy('price', 'desc'),
                    default => $q->latest()
                };
            })
            ->where('status', 'available')
            ->get();

        return view('livewire.item-filter', [
            'items' => $items,
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
