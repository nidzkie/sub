<?php

namespace Tests\Feature;

use App\Livewire\HomePage;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageCategoryFilterConnectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_selecting_category_sets_state_and_dispatches_filter_event(): void
    {
        $category = Category::query()->create([
            'name' => 'Test Home Category',
            'slug' => 'test-home-category',
            'icon' => 'spark',
            'is_active' => true,
        ]);

        Livewire::test(HomePage::class)
            ->call('selectCategory', $category->id)
            ->assertSet('selectedCategory.id', $category->id)
            ->assertDispatched('category-selected');
    }

    public function test_selecting_same_category_again_clears_filter_and_dispatches_event(): void
    {
        $category = Category::query()->create([
            'name' => 'Test Home Category Toggle',
            'slug' => 'test-home-category-toggle',
            'icon' => 'spark',
            'is_active' => true,
        ]);

        Livewire::test(HomePage::class)
            ->call('selectCategory', $category->id)
            ->call('selectCategory', $category->id)
            ->assertSet('selectedCategory', null)
            ->assertDispatched('category-selected');
    }
}
