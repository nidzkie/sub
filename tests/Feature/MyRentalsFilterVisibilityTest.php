<?php

namespace Tests\Feature;

use App\Livewire\MyRentals;
use App\Models\Category;
use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Carbon\Carbon;
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

    public function test_days_left_displays_whole_days_for_partial_day_difference(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-04-25 08:00:00'));

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
            'start_date' => now()->subDay(),
            'end_date' => now()->addDays(3)->subHours(4),
            'total_price' => 100,
            'status' => 'active',
        ]);

        $this->actingAs($renter);

        Livewire::test(MyRentals::class)
            ->assertSee('3 days');

        Carbon::setTestNow();
    }

    public function test_future_start_active_rental_is_shown_as_on_process_and_not_due_soon(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-04-25 08:00:00'));

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
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(5),
            'total_price' => 100,
            'status' => 'active',
        ]);

        $this->actingAs($renter);

        Livewire::test(MyRentals::class)
            ->assertSee('On Process')
            ->assertDontSee('1 rental(s) due soon!');

        Carbon::setTestNow();
    }
}
