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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches');
            $table->string('code_product');
            $table->string('product_name');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('brand');
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('buying_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->foreign('type_id')->references('id')->on('typesofgoods');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
