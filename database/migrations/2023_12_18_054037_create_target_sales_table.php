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
        $table->string('manager_name');
        $table->string('month_target');
        $table->integer('year_target');
        $table->decimal('target_sales', 10, 2);
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
