<?php

namespace Tests\Feature;

use App\Livewire\ViewItem;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ViewItemRentalValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_rental_rejects_past_start_date(): void
    {
        [, $renter, $item] = $this->createItemScenario();

        $this->actingAs($renter);

        Livewire::test(ViewItem::class, ['id' => $item->id])
            ->set('startDate', now()->subDay()->toDateString())
            ->set('endDate', now()->addDay()->toDateString())
            ->call('requestRental')
            ->assertHasErrors(['startDate' => ['after_or_equal']]);
    }

    public function test_request_rental_rejects_end_date_before_start_date(): void
    {
        [, $renter, $item] = $this->createItemScenario();

        $this->actingAs($renter);

        Livewire::test(ViewItem::class, ['id' => $item->id])
            ->set('startDate', now()->addDays(3)->toDateString())
            ->set('endDate', now()->addDay()->toDateString())
            ->call('requestRental')
            ->assertHasErrors(['endDate' => ['after']]);
    }

    /**
     * @return array{0: User, 1: User, 2: Item}
     */
    private function createItemScenario(): array
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
            'category_id' => $category->id,
        ]);

        return [$owner, $renter, $item];
    }
}
