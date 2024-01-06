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
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches');
            $table->string('code_purchase');
            $table->dateTime('transaction_date');
            $table->string('code_product');
            $table->string('product_name');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('brand');
            $table->integer('quantity');
            $table->string('supplier_name');
            $table->decimal('buying_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('supplier_id') ->nullable();
            $table->unsignedBigInteger('product_id') ->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('typesofgoods');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('payment_method_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_transactions');
    }
};
