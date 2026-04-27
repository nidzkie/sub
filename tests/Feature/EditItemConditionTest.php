<?php

namespace Tests\Feature;

use App\Livewire\EditItem;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditItemConditionTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_item_page_shows_condition_field_and_dark_mode_classes(): void
    {
        $user = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $user->id,
            'name' => 'JBL Speaker',
            'description' => 'Portable speaker',
            'price' => 500,
            'condition' => 'Good',
            'status' => 'available',
            'category' => 'electronics',
            'category_id' => $category->id,
        ]);

        $this->actingAs($user)
            ->get(route('edit-item', $item))
            ->assertOk()
            ->assertSee('wire:model="condition"', false)
            ->assertSee('dark:bg-slate-900', false);
    }

    public function test_owner_can_update_item_condition_from_edit_item_component(): void
    {
        $user = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $user->id,
            'name' => 'JBL Speaker',
            'description' => 'Portable speaker',
            'price' => 500,
            'condition' => 'Good',
            'status' => 'available',
            'category' => 'electronics',
            'category_id' => $category->id,
        ]);

        $this->actingAs($user);

        Livewire::test(EditItem::class, ['item' => $item])
            ->set('name', 'JBL PartyBox')
            ->set('description', 'Portable speaker with wireless mic')
            ->set('price', '550')
            ->set('condition', 'Like New')
            ->set('category_id', (string) $category->id)
            ->set('status', 'available')
            ->call('update')
            ->assertRedirect('/my-listings');

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'condition' => 'Like New',
            'name' => 'JBL PartyBox',
        ]);
    }
}
