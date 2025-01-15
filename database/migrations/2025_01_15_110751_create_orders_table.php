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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->nullable()->comment('user id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('productID')->nullable()->comment('productID')->constrained('product')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('quantity'); 
            $table->decimal('totalPrice', 10, 2); 
            $table->string('status')->default('Pending'); 
            $table->timestamps(); 
        });
    }
    
};
