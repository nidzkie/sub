<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('rentals', 'paid_amount')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->decimal('paid_amount', 8, 2)->default(0)->after('total_price');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('rentals', 'paid_amount')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->dropColumn('paid_amount');
            });
        }
    }
};
