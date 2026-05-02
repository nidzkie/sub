<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function hasIndex(string $table, string $indexName): bool
    {
        if (DB::getDriverName() !== 'mysql') {
            return false;
        }

        $databaseName = DB::getDatabaseName();

        return DB::table('information_schema.statistics')
            ->where('table_schema', $databaseName)
            ->where('table_name', $table)
            ->where('index_name', $indexName)
            ->exists();
    }

    private function hasCheckConstraint(string $table, string $constraintName): bool
    {
        if (DB::getDriverName() !== 'mysql') {
            return false;
        }

        $databaseName = DB::getDatabaseName();

        return DB::table('information_schema.table_constraints')
            ->where('table_schema', $databaseName)
            ->where('table_name', $table)
            ->where('constraint_type', 'CHECK')
            ->where('constraint_name', $constraintName)
            ->exists();
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $addItemsStatusIndex = ! $this->hasIndex('items', 'items_status_index');
        $addItemsPriceIndex = ! $this->hasIndex('items', 'items_price_index');
        $addItemsCreatedAtIndex = ! $this->hasIndex('items', 'items_created_at_index');
        $addItemsStatusCreatedAtIndex = ! $this->hasIndex('items', 'items_status_created_at_index');

        Schema::table('items', function (Blueprint $table) use (
            $addItemsStatusIndex,
            $addItemsPriceIndex,
            $addItemsCreatedAtIndex,
            $addItemsStatusCreatedAtIndex
        ) {
            if ($addItemsStatusIndex) {
                $table->index('status', 'items_status_index');
            }

            if ($addItemsPriceIndex) {
                $table->index('price', 'items_price_index');
            }

            if ($addItemsCreatedAtIndex) {
                $table->index('created_at', 'items_created_at_index');
            }

            if ($addItemsStatusCreatedAtIndex) {
                $table->index(['status', 'created_at'], 'items_status_created_at_index');
            }

            if (! Schema::hasColumn('items', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        $addRentalsRenterStatusIndex = ! $this->hasIndex('rentals', 'rentals_renter_id_status_index');
        $addRentalsItemStatusIndex = ! $this->hasIndex('rentals', 'rentals_item_id_status_index');

        Schema::table('rentals', function (Blueprint $table) use (
            $addRentalsRenterStatusIndex,
            $addRentalsItemStatusIndex
        ) {
            if ($addRentalsRenterStatusIndex) {
                $table->index(['renter_id', 'status'], 'rentals_renter_id_status_index');
            }

            if ($addRentalsItemStatusIndex) {
                $table->index(['item_id', 'status'], 'rentals_item_id_status_index');
            }

            if (! Schema::hasColumn('rentals', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('status');
            }

            if (! Schema::hasColumn('rentals', 'active_at')) {
                $table->timestamp('active_at')->nullable()->after('approved_at');
            }

            if (! Schema::hasColumn('rentals', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('active_at');
            }

            if (! Schema::hasColumn('rentals', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable()->after('completed_at');
            }

            if (! Schema::hasColumn('rentals', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::statement("UPDATE rentals SET payment_status = 'outstanding' WHERE payment_status IS NULL OR payment_status = '' OR payment_status NOT IN ('outstanding', 'partial', 'fully_paid')");
            DB::statement("UPDATE rentals SET status = 'pending' WHERE status IS NULL OR status = '' OR status NOT IN ('pending', 'approved', 'active', 'completed', 'cancelled')");
            DB::statement('UPDATE rentals SET end_date = DATE_ADD(start_date, INTERVAL 1 DAY) WHERE end_date <= start_date');
            DB::statement("UPDATE items SET status = 'available' WHERE status IS NULL OR status = '' OR status NOT IN ('available', 'rented', 'maintenance')");

            if (! $this->hasCheckConstraint('rentals', 'rentals_dates_chronological_check')) {
                DB::statement('ALTER TABLE rentals ADD CONSTRAINT rentals_dates_chronological_check CHECK (end_date > start_date)');
            }

            if (! $this->hasCheckConstraint('rentals', 'rentals_status_check')) {
                DB::statement("ALTER TABLE rentals ADD CONSTRAINT rentals_status_check CHECK (status IN ('pending', 'approved', 'active', 'completed', 'cancelled'))");
            }

            if (! $this->hasCheckConstraint('rentals', 'rentals_payment_status_check')) {
                DB::statement("ALTER TABLE rentals ADD CONSTRAINT rentals_payment_status_check CHECK (payment_status IN ('outstanding', 'partial', 'fully_paid'))");
            }

            if (! $this->hasCheckConstraint('items', 'items_status_check')) {
                DB::statement("ALTER TABLE items ADD CONSTRAINT items_status_check CHECK (status IN ('available', 'rented', 'maintenance'))");
            }

            DB::statement('ALTER TABLE users MODIFY rating DECIMAL(3,1) NOT NULL DEFAULT 0');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            if ($this->hasCheckConstraint('rentals', 'rentals_dates_chronological_check')) {
                DB::statement('ALTER TABLE rentals DROP CHECK rentals_dates_chronological_check');
            }

            if ($this->hasCheckConstraint('rentals', 'rentals_status_check')) {
                DB::statement('ALTER TABLE rentals DROP CHECK rentals_status_check');
            }

            if ($this->hasCheckConstraint('rentals', 'rentals_payment_status_check')) {
                DB::statement('ALTER TABLE rentals DROP CHECK rentals_payment_status_check');
            }

            if ($this->hasCheckConstraint('items', 'items_status_check')) {
                DB::statement('ALTER TABLE items DROP CHECK items_status_check');
            }

            DB::statement('ALTER TABLE users MODIFY rating DECIMAL(3,2) NOT NULL DEFAULT 0');
        }

        Schema::table('rentals', function (Blueprint $table) {
            if ($this->hasIndex('rentals', 'rentals_renter_id_status_index')) {
                $table->dropIndex('rentals_renter_id_status_index');
            }

            if ($this->hasIndex('rentals', 'rentals_item_id_status_index')) {
                $table->dropIndex('rentals_item_id_status_index');
            }

            if (Schema::hasColumn('rentals', 'approved_at')) {
                $table->dropColumn('approved_at');
            }

            if (Schema::hasColumn('rentals', 'active_at')) {
                $table->dropColumn('active_at');
            }

            if (Schema::hasColumn('rentals', 'completed_at')) {
                $table->dropColumn('completed_at');
            }

            if (Schema::hasColumn('rentals', 'cancelled_at')) {
                $table->dropColumn('cancelled_at');
            }

            if (Schema::hasColumn('rentals', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });

        Schema::table('items', function (Blueprint $table) {
            if ($this->hasIndex('items', 'items_status_index')) {
                $table->dropIndex('items_status_index');
            }

            if ($this->hasIndex('items', 'items_price_index')) {
                $table->dropIndex('items_price_index');
            }

            if ($this->hasIndex('items', 'items_created_at_index')) {
                $table->dropIndex('items_created_at_index');
            }

            if ($this->hasIndex('items', 'items_status_created_at_index')) {
                $table->dropIndex('items_status_created_at_index');
            }

            if (Schema::hasColumn('items', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};
