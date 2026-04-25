<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        $catalog = [
            'books' => ['name' => 'Books', 'icon' => 'book', 'aliases' => ['books']],
            'electronics-gadgets' => [
                'name' => 'Electronics & Gadgets',
                'icon' => 'device',
                'aliases' => ['electronics-gadgets', 'electronics', 'gadgets'],
            ],
            'tools' => ['name' => 'Tools', 'icon' => 'tool', 'aliases' => ['tools']],
            'sports-pe' => [
                'name' => 'Sports & PE Essentials',
                'icon' => 'fitness',
                'aliases' => ['sports-pe', 'sports-pe-essentials'],
            ],
            'school-supplies-accessories' => [
                'name' => 'School Supplies & Accessories',
                'icon' => 'pencil',
                'aliases' => ['school-supplies-accessories', 'school-supplies', 'accessories'],
            ],
            'clothing' => [
                'name' => 'Clothing',
                'icon' => 'shirt',
                'aliases' => ['clothing', 'clothes', 'apparel'],
            ],
        ];

        DB::transaction(function () use ($catalog): void {
            foreach ($catalog as $canonicalSlug => $definition) {
                $aliases = collect($definition['aliases'])->unique()->values()->all();

                $existingCategories = DB::table('categories')
                    ->whereIn('slug', $aliases)
                    ->orWhere('name', $definition['name'])
                    ->orderBy('id')
                    ->get();

                $canonicalCategory = $existingCategories
                    ->firstWhere('slug', $canonicalSlug)
                    ?? $existingCategories->first();

                if ($canonicalCategory) {
                    DB::table('categories')
                        ->where('id', $canonicalCategory->id)
                        ->update([
                            'name' => $definition['name'],
                            'slug' => $canonicalSlug,
                            'icon' => $definition['icon'],
                            'is_active' => true,
                            'updated_at' => now(),
                        ]);

                    $canonicalId = $canonicalCategory->id;
                } else {
                    $canonicalId = DB::table('categories')->insertGetId([
                        'name' => $definition['name'],
                        'slug' => $canonicalSlug,
                        'icon' => $definition['icon'],
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $duplicateCategoryIds = $existingCategories
                    ->pluck('id')
                    ->filter(fn (int $id): bool => $id !== $canonicalId)
                    ->values();

                if (Schema::hasTable('items')) {
                    if ($duplicateCategoryIds->isNotEmpty()) {
                        DB::table('items')
                            ->whereIn('category_id', $duplicateCategoryIds->all())
                            ->update([
                                'category_id' => $canonicalId,
                                'category' => $canonicalSlug,
                            ]);
                    }

                    DB::table('items')
                        ->whereIn('category', $aliases)
                        ->update(['category' => $canonicalSlug, 'category_id' => $canonicalId]);
                }

                if ($duplicateCategoryIds->isNotEmpty()) {
                    DB::table('categories')
                        ->whereIn('id', $duplicateCategoryIds->all())
                        ->delete();
                }
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        DB::transaction(function (): void {
            $electronicsGadgets = DB::table('categories')
                ->where('slug', 'electronics-gadgets')
                ->first();

            if ($electronicsGadgets) {
                DB::table('categories')->where('id', $electronicsGadgets->id)->update([
                    'name' => 'Electronics',
                    'slug' => 'electronics',
                    'icon' => 'speaker',
                    'updated_at' => now(),
                ]);

                DB::table('categories')->updateOrInsert(
                    ['slug' => 'gadgets'],
                    ['name' => 'Gadgets', 'icon' => 'device', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]
                );
            }

            $schoolAccessories = DB::table('categories')
                ->where('slug', 'school-supplies-accessories')
                ->first();

            if ($schoolAccessories) {
                DB::table('categories')->where('id', $schoolAccessories->id)->update([
                    'name' => 'Accessories',
                    'slug' => 'accessories',
                    'icon' => 'spark',
                    'updated_at' => now(),
                ]);
            }
        });
    }
};
