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
        Schema::create('sale_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches');
            $table->string('code_sale')->unique();
            $table->dateTime('transaction_date');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->string('discount_name')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('discount_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_records');
    }
};
