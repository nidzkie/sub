<?php

namespace Tests\Feature;

use App\Livewire\MyListings;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MyListingsDeleteModalTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_open_delete_modal_and_delete_item(): void
    {
        $owner = User::factory()->create();

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Portable Projector',
            'description' => 'Compact classroom projector',
            'condition' => 'Good',
            'price' => 150,
            'status' => 'available',
        ]);

        $this->actingAs($owner);

        Livewire::test(MyListings::class)
            ->call('confirmDeleteItem', $item->id)
            ->assertSet('showDeleteModal', true)
            ->assertSee('Confirm Delete')
            ->assertSee('Portable Projector')
            ->call('deleteItem')
            ->assertSet('showDeleteModal', false);

        $this->assertSoftDeleted('items', ['id' => $item->id]);
    }
}
