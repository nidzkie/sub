<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;

class HomePage extends Component
{
    public ?Category $selectedCategory = null;

    public function mount(?Category $category = null): void
    {
        $this->selectedCategory = $category;
    }

    public function selectCategory(int $categoryId): void
    {
        $this->selectedCategory = Category::query()
            ->where('is_active', true)
            ->find($categoryId);
    }

    public function render()
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount([
                'items as available_items_count' => fn ($query) => $query->where('status', 'available'),
            ])
            ->orderBy('name')
            ->get();

        $featuredItemsQuery = Item::query()
            ->where('status', 'available')
            ->with(['user', 'categoryRecord'])
            ->latest();

        if ($this->selectedCategory) {
            $featuredItemsQuery->where('category_id', $this->selectedCategory->id);
        }

        $featuredItems = $featuredItemsQuery
            ->take(10)
            ->get();

        return view('livewire.home-page', [
            'categories' => $categories,
            'featuredItems' => $featuredItems,
        ])->layout('layouts.guest');
    }
}
