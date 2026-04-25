<?php

namespace Tests\Feature;

use App\Livewire\MyRentals;
use App\Models\Category;
use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MyRentalsFilterVisibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_filters_stay_visible_when_selected_filter_has_no_results(): void
    {
        $renter = User::factory()->create();
        $owner = User::factory()->create();

        $category = Category::query()->create([
            'name' => 'Books',
            'slug' => 'books',
            'icon' => 'book',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Sample Item',
            'description' => 'Sample Description',
            'price' => 50,
            'status' => 'available',
            'category' => $category->slug,
            'category_id' => $category->id,
        ]);

        Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $renter->id,
            'start_date' => now(),
            'end_date' => now()->addDays(2),
            'total_price' => 100,
            'status' => 'pending',
        ]);

        $this->actingAs($renter);

        Livewire::test(MyRentals::class)
            ->call('setFilter', 'due_soon')
            ->assertSee('All Rentals')
            ->assertSee('Pending')
            ->assertSee('Due Soon')
            ->assertSee('Ongoing')
            ->assertSee('No rentals for this filter');
    }
}
