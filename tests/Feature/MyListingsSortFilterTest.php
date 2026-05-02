<?php

namespace Tests\Feature;

use App\Livewire\MyListings;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MyListingsSortFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_my_listings_supports_sorting_by_price_and_name(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Zeta Toolkit',
            'description' => 'Toolkit for labs',
            'condition' => 'Good',
            'price' => 300,
            'status' => 'available',
        ]);

        Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Alpha Kit',
            'description' => 'Starter rental kit',
            'condition' => 'Good',
            'price' => 100,
            'status' => 'available',
        ]);

        Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Midrange Set',
            'description' => 'Mid-priced item',
            'condition' => 'Good',
            'price' => 200,
            'status' => 'available',
        ]);

        Item::query()->create([
            'user_id' => $otherUser->id,
            'name' => 'Other User Item',
            'description' => 'Should not be visible to owner',
            'condition' => 'Good',
            'price' => 10,
            'status' => 'available',
        ]);

        $this->actingAs($owner);

        Livewire::test(MyListings::class)
            ->set('sortBy', 'price_low_high')
            ->assertSeeInOrder(['Alpha Kit', 'Midrange Set', 'Zeta Toolkit'])
            ->assertDontSee('Other User Item')
            ->set('sortBy', 'name_desc')
            ->assertSeeInOrder(['Zeta Toolkit', 'Midrange Set', 'Alpha Kit']);
    }
}
