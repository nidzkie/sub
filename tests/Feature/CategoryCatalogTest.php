<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_catalog_uses_canonical_names_without_duplicates(): void
    {
        $categoryNames = Category::query()->pluck('name');

        $this->assertTrue($categoryNames->contains('Books'));
        $this->assertTrue($categoryNames->contains('Electronics & Gadgets'));
        $this->assertTrue($categoryNames->contains('School Supplies & Accessories'));
        $this->assertTrue($categoryNames->contains('Clothing'));

        $this->assertFalse($categoryNames->contains('Electronics'));
        $this->assertFalse($categoryNames->contains('Gadgets'));
        $this->assertFalse($categoryNames->contains('Accessories'));

        $duplicateNames = $categoryNames
            ->countBy()
            ->filter(fn (int $count): bool => $count > 1);

        $this->assertCount(0, $duplicateNames);
    }
}
