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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->foreignId('categoryID')->nullable()->comment('categoryID')->constrained('category')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subcategoryID')->nullable()->comment('subcategoryID')->constrained('subcategory')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('price', 8, 2)->nullable();
            $table->date('expiryDate')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
