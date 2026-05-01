<?php

namespace Tests\Feature;

use App\Livewire\ItemFilter;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemFilterShowMoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_load_more_increases_visible_item_count_by_batch_size(): void
    {
        $component = new ItemFilter;

        $this->assertSame(ItemFilter::ITEMS_PER_BATCH, $component->itemsToShow);

        $component->loadMore();

        $this->assertSame(ItemFilter::ITEMS_PER_BATCH * 2, $component->itemsToShow);
    }

    public function test_render_provides_can_load_more_when_available_items_exceed_initial_batch(): void
    {
        $user = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Accessories',
            'slug' => 'accessories-show-more-test',
            'icon' => 'spark',
            'is_active' => true,
        ]);

        for ($index = 1; $index <= 13; $index++) {
            Item::query()->create([
                'user_id' => $user->id,
                'name' => sprintf('Filter Item %02d', $index),
                'description' => 'Demo description',
                'price' => $index * 10,
                'condition' => 'Good',
                'status' => 'available',
                'category_id' => $category->id,
            ]);
        }

        $component = new ItemFilter;
        $view = $component->render();
        $data = $view->getData();

        $this->assertCount(ItemFilter::ITEMS_PER_BATCH, $data['items']);
        $this->assertTrue($data['canLoadMore']);
        $this->assertSame(13, $data['totalItems']);
    }
}
