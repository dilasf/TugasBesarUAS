<?php
use App\Http\Controllers\Penjualan;

Route::middleware('auth')->group(function(){
    Route::get('/Penjualan', [PenjualanController::class, 'index'])->name('Penjualan');
});