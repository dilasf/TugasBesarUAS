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
    Schema::create('target_sales', function (Blueprint $table) {
        $table->id();
        $table->foreignId('branch_id')->constrained('branches');
        $table->string('manager_name');
        $table->foreignId('position_id')->constrained('positions');
        $table->string('bulan');
        $table->decimal('target_penjualan', 10, 2);
        $table->decimal('penjualan_aktual', 10, 2);
        $table->decimal('selisih', 10, 2);
        $table->dateTime('created_at')->nullable();
        $table->dateTime('updated_at')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_sales');
    }
};
