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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->nullable()->comment('user id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('productID')->nullable()->comment('productID')->constrained('product')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->integer('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};

