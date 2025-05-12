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
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->bigIncrements('transaction_item_id'); // Primary key for transaction items
            $table->unsignedBigInteger('transaction_id'); // Foreign key to transactions
            $table->foreign('transaction_id')->references('transaction_id')->on('transactions')->onDelete('cascade');
            
            $table->unsignedBigInteger('product_id'); // Foreign key to products
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            
            $table->integer('quantity'); // Quantity of the product
            $table->decimal('price', 10, 2); // Price at the time of purchase
            $table->decimal('discount', 10, 2); // Discount applied per item
            $table->timestamps(); // Timestamps (created_at and updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
