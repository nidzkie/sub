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
        if (! Schema::hasColumn('rentals', 'payment_status')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->string('payment_status')->default('outstanding')->after('total_price');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('rentals', 'payment_status')) {
            Schema::table('rentals', function (Blueprint $table) {
                $table->dropColumn('payment_status');
            });
        }
    }
};
