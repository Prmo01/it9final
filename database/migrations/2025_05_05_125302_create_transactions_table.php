<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('transaction_id'); // Custom name for the primary key
            $table->decimal('total', 10, 2); // Sum of all items before tax/discount
            $table->decimal('discount', 10, 2); // ₱ discount (fixed amount)
            $table->decimal('total_with_tax', 10, 2); // Final total after tax
            $table->string('payment_method'); // Cash, Card, GCash, etc.
            $table->decimal('payment_amount', 10, 2); // Amount paid by customer
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
