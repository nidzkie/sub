<?php

namespace Tests\Feature;

use App\Livewire\ItemFilter;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ItemFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_clear_search_resets_search_value(): void
    {
        Livewire::test(ItemFilter::class)
            ->set('search', 'calculator')
            ->call('clearSearch')
            ->assertSet('search', '');
    }

    public function test_selected_category_id_applies_initial_item_filter(): void
    {
        $user = User::factory()->create();

        $booksCategory = Category::query()->create([
            'name' => 'Books',
            'slug' => 'books',
            'icon' => 'book',
            'is_active' => true,
        ]);

        $toolsCategory = Category::query()->create([
            'name' => 'Tools',
            'slug' => 'tools',
            'icon' => 'tool',
            'is_active' => true,
        ]);

        Item::query()->create([
            'user_id' => $user->id,
            'name' => 'Engineering Calculator',
            'description' => 'Scientific calculator',
            'price' => 40,
            'condition' => 'Good',
            'status' => 'available',
            'category' => $booksCategory->slug,
            'category_id' => $booksCategory->id,
        ]);

        Item::query()->create([
            'user_id' => $user->id,
            'name' => 'Hammer Set',
            'description' => 'Basic hammer set',
            'price' => 75,
            'condition' => 'Good',
            'status' => 'available',
            'category' => $toolsCategory->slug,
            'category_id' => $toolsCategory->id,
        ]);

        Livewire::test(ItemFilter::class, ['selectedCategoryId' => $booksCategory->id])
            ->assertSet('category', (string) $booksCategory->id)
            ->assertSee('Engineering Calculator')
            ->assertDontSee('Hammer Set');
    }

    public function test_apply_category_filter_updates_category_state(): void
    {
        Livewire::test(ItemFilter::class)
            ->call('applyCategoryFilter', 5)
            ->assertSet('category', '5')
            ->call('applyCategoryFilter', null)
            ->assertSet('category', '');
    }
}
