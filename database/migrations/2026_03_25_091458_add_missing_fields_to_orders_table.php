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
    // --- PART 1: FIXING THE ORDERS TABLE ---
    Schema::table('orders', function ($table) {
        if (!Schema::hasColumn('orders', 'order_number')) {
            $table->string('order_number')->nullable()->after('user_id');
        }
        if (!Schema::hasColumn('orders', 'total_amount')) {
            $table->decimal('total_amount', 10, 2)->nullable()->after('user_id');
        }
        if (!Schema::hasColumn('orders', 'delivery_address')) {
            $table->text('delivery_address')->nullable()->after('status');
        }
    });

    // --- PART 2: FIXING THE ORDER_ITEMS TABLE (Your current error) ---
    Schema::table('order_items', function ($table) {
        if (!Schema::hasColumn('order_items', 'food_id')) {
            // Adding the missing food_id column
            $table->unsignedBigInteger('food_id')->nullable()->after('order_id');
        }
        
        if (!Schema::hasColumn('order_items', 'food_name')) {
            $table->string('food_name')->nullable()->after('food_id');
        }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
