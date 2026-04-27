<?php

namespace Tests\Feature;

use App\Livewire\AddNewItem;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AddNewItemConditionTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_create_item_with_selected_condition(): void
    {
        $user = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $this->actingAs($user);

        Livewire::test(AddNewItem::class)
            ->set('name', 'Scientific Calculator')
            ->set('description', 'Casio calculator in good condition.')
            ->set('price', '50')
            ->set('condition', 'Fair')
            ->set('category_id', (string) $category->id)
            ->call('submit')
            ->assertRedirect('/my-listings');

        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'name' => 'Scientific Calculator',
            'condition' => 'Fair',
            'category_id' => $category->id,
        ]);

        $this->assertSame('Fair', Item::query()->firstOrFail()->condition);
    }
}
