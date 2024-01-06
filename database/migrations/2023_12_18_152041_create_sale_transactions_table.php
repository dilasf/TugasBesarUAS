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
        Schema::create('sale_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches');
            $table->string('code_sale');
            $table->dateTime('transaction_date');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->string('discount_name')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('discount_id')->nullable();

            // Kolom untuk transaksi
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->decimal('total_price_after_discount', 10, 2)->nullable();
            $table->decimal('total_payment', 10, 2)->nullable();
            $table->decimal('change_amount', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_transactions');
    }
};
