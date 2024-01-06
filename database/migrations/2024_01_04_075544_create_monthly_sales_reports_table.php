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
        Schema::create('monthly_sales_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained();
            $table->integer('year');
            $table->integer('month');
            $table->decimal('total_revenue', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_sales_reports');
    }
};
