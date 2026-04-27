<?php

namespace Tests\Feature;

use App\Livewire\MyListings;
use App\Models\Category;
use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MyListingsViewRequestButtonTest extends TestCase
{
    use RefreshDatabase;

    public function test_my_listings_view_request_button_links_to_owner_rental_request_view(): void
    {
        $owner = User::factory()->create();
        $renter = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Portable Speaker',
            'description' => 'Bluetooth speaker',
            'price' => 50,
            'status' => 'available',
            'category' => 'electronics',
            'category_id' => $category->id,
        ]);

        $rental = Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $renter->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(2),
            'total_price' => 100,
            'paid_amount' => 0,
            'payment_status' => 'outstanding',
            'status' => 'pending',
        ]);

        $this->actingAs($owner);

        Livewire::test(MyListings::class)
            ->assertSee('View Request')
            ->assertSee(route('rental-requests.show', $rental));
    }
}
