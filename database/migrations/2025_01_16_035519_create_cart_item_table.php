<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cartID')->nullable()->comment('cartID')->constrained('cart')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('productID')->nullable()->comment('productID')->constrained('product')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unitPrice', 10, 2);
            $table->decimal('lineTotal', 10, 2);
            $table->timestamps();
    

        });
    }
};
