<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    // Change 'orders' to 'food' here! Your screenshot showed 'orders' by mistake.
    Schema::create('food', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('khmer_name')->nullable(); // Added this to match your Model
        $table->text('description')->nullable();
        $table->decimal('price', 8, 2);
        $table->string('category'); 
        $table->string('image')->nullable();
        $table->boolean('is_popular')->default(false);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};