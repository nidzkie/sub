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

        DB::table('categories')
            ->where('slug', 'school-supplies-accessories')
            ->orWhere('name', 'School Supplies & Accessories')
            ->update([
                'name' => 'School Supplies',
                'updated_at' => now(),
            ]);

        DB::table('categories')
            ->where('slug', 'clothing')
            ->orWhere('name', 'Clothing')
            ->update([
                'name' => 'Clothing & Accessories',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        DB::table('categories')
            ->where('slug', 'school-supplies-accessories')
            ->orWhere('name', 'School Supplies')
            ->update([
                'name' => 'School Supplies & Accessories',
                'updated_at' => now(),
            ]);

        DB::table('categories')
            ->where('slug', 'clothing')
            ->orWhere('name', 'Clothing & Accessories')
            ->update([
                'name' => 'Clothing',
                'updated_at' => now(),
            ]);
    }
};
