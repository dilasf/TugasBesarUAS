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
        Schema::create('purchase_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches');
            $table->string('code_purchase');
            $table->string('code_product');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('purchase_price', 10, 2);
            $table->dateTime('transaction_date');
            $table->string('supplier_name');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('product_id') ->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_records');
    }
};
