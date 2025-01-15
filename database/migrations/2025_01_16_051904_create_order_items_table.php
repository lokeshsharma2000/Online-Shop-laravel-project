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
        Schema::create('orderItems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderID')->constrained('orders')->onDelete('cascade'); // Foreign key referencing orders table
            $table->foreignId('productID')->constrained('product')->onDelete('cascade'); // Foreign key referencing products table
            $table->integer('quantity'); // Number of items in the order
            $table->decimal('price', 8, 2); // Price of the product at the time of order
            $table->decimal('total', 8, 2); // Total price for the product (price * quantity)
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderItems');
    }
};
