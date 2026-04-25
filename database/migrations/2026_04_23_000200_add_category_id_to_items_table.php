<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')->constrained()->nullOnDelete();
        });

        $categories = DB::table('categories')->pluck('id', 'slug');

        if (Schema::hasColumn('items', 'category')) {
            DB::table('items')->select('id', 'category')->orderBy('id')->chunkById(100, function ($items) use ($categories) {
                foreach ($items as $item) {
                    $legacySlug = $item->category ?: 'books';
                    $normalizedSlug = match ($legacySlug) {
                        'electronics', 'gadgets', 'electronics-and-gadgets' => 'electronics-gadgets',
                        'accessories', 'school-supplies' => 'school-supplies-accessories',
                        default => $legacySlug,
                    };

                    DB::table('items')
                        ->where('id', $item->id)
                        ->update(['category_id' => $categories[$normalizedSlug] ?? $categories['books'] ?? null]);
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
