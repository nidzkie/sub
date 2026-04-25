<?php

namespace Tests\Feature;

use App\Livewire\RentInventoryManagement;
use App\Models\Category;
use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RentInventoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_and_manage_pending_request(): void
    {
        $owner = User::factory()->create();
        $borrower = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Books',
            'slug' => 'books',
            'icon' => 'book',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Linear Algebra Book',
            'description' => 'Hardbound copy',
            'price' => 50,
            'status' => 'available',
            'category' => 'books',
            'category_id' => $category->id,
        ]);

        $rental = Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $borrower->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(3),
            'total_price' => 100,
            'payment_status' => 'outstanding',
            'status' => 'pending',
        ]);

        $this->actingAs($owner);

        Livewire::test(RentInventoryManagement::class)
            ->assertSee('Rent Inventory Management')
            ->assertSee('Pending Request')
            ->call('updatePaymentStatus', $rental->id, 'partial')
            ->call('approveRequest', $rental->id)
            ->assertSee('Rental request approved.');

        $rental->refresh();
        $item->refresh();

        $this->assertSame('partial', $rental->payment_status);
        $this->assertSame('active', $rental->status);
        $this->assertSame('rented', $item->status);
    }
}
