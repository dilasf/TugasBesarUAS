<?php
use App\Http\Controllers\Pengguna;

Route::middleware('auth')->group(function(){
    Route::get('/Pengguna', [PenggunaController::class, 'index'])->name('Pengguna');
});
