<?php

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HistoryPurchaseTransactionController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseRecordsController;
use App\Http\Controllers\PurchaseTransactionController;
use App\Http\Controllers\ReportPurchaseTransactionController;
use App\Http\Controllers\SaleRecordController;
use App\Http\Controllers\SaleTransactionController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\TransactionReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['role:Warehouse Staff'])->group(function () {
//     Route::get('/warehouse_staff_dashboard', function () {
//         // Logic for the warehouse staff dashboard
//     })->name('warehouse_staff_dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/manage_goods', [ProductController::class, 'index'])->name('minimarket.manage_goods');
    Route::get('/minimarket/manage_goods/create', [ProductController::class, 'create'])->name('minimarket.manage_goods.create');
    Route::post('/minimarket/manage_goods', [ProductController::class, 'store'])->name('minimarket.manage_goods.store');
    Route::get('/minimarket/manage_goods/{id}/edit', [ProductController::class, 'edit'])->name('minimarket.manage_goods.edit');
    Route::match(['put', 'patch'],'/minimarket/manage_goods/{id}', [ProductController::class, 'update'])->name('minimarket.manage_goods.update');
    Route::delete('/minimarket/manage_goods/{id}', [ProductController::class, 'destroy'])->name('minimarket.manage_goods.destroy');
});


Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/manage_goods/transaction/create', [PurchaseTransactionController::class, 'create'])->name('minimarket.manage_goods.transaction.create');
    Route::post('/minimarket/manage_goods/transaction', [PurchaseTransactionController::class, 'store'])->name('minimarket.manage_goods.transaction.store');
});

Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/manage_goods/suppliers', [SupplierController::class, 'index'])->name('minimarket.manage_goods.suppliers');
    Route::get('/minimarket/manage_goods/suppliers/create', [SupplierController::class, 'create'])->name('minimarket.manage_goods.suppliers.create');
    Route::post('/minimarket/manage_goods/suppliers', [SupplierController::class, 'store'])->name('minimarket.manage_goods.suppliers.store');
    Route::get('/minimarket/manage_goods/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('minimarket.manage_goods.suppliers.edit');
    Route::match(['put', 'patch'],'/minimarket/manage_goods/suppliers/{id}', [SupplierController::class, 'update'])->name('minimarket.manage_goods.suppliers.update');
    Route::delete('/minimarket/manage_goods/suppliers/suppliers/{id}', [SupplierController::class, 'destroy'])->name('minimarket.manage_goods.suppliers.destroy');
});

Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/Records/purchase', [PurchaseRecordsController::class, 'index'])->name('minimarket.Records.purchase');
});

Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/manage_goods/report', [ReportPurchaseTransactionController::class, 'index'])
        ->name('minimarket.manage_goods.report');
});


Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/minimarket/manage_transactions', [SaleTransactionController::class, 'index'])->name('minimarket.manage_transactions');
    Route::get('/minimarket/manage_transactions/create', [SaleTransactionController::class, 'create'])->name('minimarket.manage_transactions.create');
    Route::post('/minimarket/manage_transactions', [SaleTransactionController::class, 'store'])->name('minimarket.manage_transactions.store');
    Route::get('/minimarket/manage_transactions/{id}/edit', [SaleTransactionController::class, 'edit'])->name('minimarket.manage_transactions.edit');
    Route::match(['put', 'patch'],'/minimarket/manage_transactions/{id}', [SaleTransactionController::class, 'update'])->name('minimarket.manage_transactions.update');
    Route::delete('/minimarket/manage_transactions/{id}', [SaleTransactionController::class, 'destroy'])->name('minimarket.manage_transactions.destroy');
    Route::get('/get-product/{productName}', [SaleTransactionController::class, 'getProductPrice']);
});


Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/minimarket/Records/sale', [SaleRecordController::class, 'index'])->name('minimarket.Records.sale');
});

Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/minimarket/manage_transactions/report', [TransactionReportController::class, 'index'])->name('minimarket.manage_transactions.report');
});


Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/get-discount/{discountName}', [DiscountController::class, 'getDiscount'])->name('get-discount');
    Route::get('/minimarket/manage_transactions/discount', [DiscountController::class, 'index'])->name('minimarket.manage_transactions.discount');
    Route::get('/minimarket/manage_transactions/discount/create', [DiscountController::class, 'create'])->name('minimarket.manage_transactions.discount.create');
    Route::post('/minimarket/manage_transactions/discount', [DiscountController::class, 'store'])->name('minimarket.manage_transactions.discount.store');
    Route::get('/minimarket/manage_transactions/{id}/edit', [DiscountController::class, 'edit'])->name('minimarket.manage_transactions.discount.edit');
    Route::match(['put', 'patch'],'/minimarket/manage_transactions/{id}', [DiscountController::class, 'update'])->name('minimarket.manage_transactions.discount.update');
    Route::delete('/minimarket/manage_transactions/{id}', [DiscountController::class, 'destroy'])->name('minimarket.manage_transactions.destroy');
});

Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/stock/index', [SupervisorController::class, 'index'])->name('minimarket.supervisor.stock.index');
    // Route::get('/minimarket/supervisor/history', [SupervisorController::class, 'index'])->name('Supervisor.history.index');
});

Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/history/index', [TransactionHistoryController::class, 'index'])->name('minimarket.supervisor.history.index');


});
Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/history/report', [HistoryPurchaseTransactionController::class, 'index'])->name('minimarket.supervisor.history.report');


});

Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/enmployees/index', [PenggunaController::class, 'index'])->name('minimarket.enmployees.index');
    Route::get('/minimarket/enmployees/create', [PenggunaController::class, 'create'])->name('minimarket.enmployees.create');
    Route::get('/minimarket/enmployees/edit/{id}', [PenggunaController::class, 'edit'])->name('minimarket.enmployees.edit');
    Route::put('/minimarket/enmployees/update/{id}', [PenggunaController::class, 'update'])->name('minimarket.enmployees.update');

});
Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/enmployees/karyawan', [PenggunaController::class, 'index'])->name('minimarket.enmployees.karyawan');
    Route::get('/minimarket/enmployees/karyawan/create', [PenggunaController::class, 'create'])->name('minimarket.enmployees.karyawan.create');
    Route::post('/minimarket/enmployees/karyawan', [PenggunaController::class, 'store'])->name('minimarket.enmployees.karyawan.store');

});


require __DIR__.'/auth.php';
