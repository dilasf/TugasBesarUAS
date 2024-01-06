<?php

use App\Http\Controllers\AllProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeManagerController;
use App\Http\Controllers\EmployeeOwnerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FeedbackOwnerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HistoryPurchaseTransactionController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseRecordsController;
use App\Http\Controllers\PurchaseTransactionController;
use App\Http\Controllers\ReportManagerController;
use App\Http\Controllers\ReportOwnerController;
use App\Http\Controllers\ReportPurchaseTransactionController;
use App\Http\Controllers\SaleRecordController;
use App\Http\Controllers\SaleTransactionController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TargetSalesOwnerController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Warehouse Staff
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

Route::middleware(['role:Warehouse Staff|Owner|Supervisor'])->group(function () {
    Route::get('/minimarket/manage_goods/suppliers', [SupplierController::class, 'display'])->name('minimarket.manage_goods.suppliers');
});

Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/Records/purchase', [PurchaseRecordsController::class, 'index'])->name('minimarket.Records.purchase');
});

Route::middleware(['role:Warehouse Staff'])->group(function () {
    Route::get('/minimarket/manage_goods/report', [ReportPurchaseTransactionController::class, 'index'])
        ->name('minimarket.manage_goods.report');
});


//Cashier
Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/minimarket/manage_transactions', [SaleTransactionController::class, 'index'])->name('minimarket.manage_transactions');
    Route::get('/minimarket/manage_transactions/create', [SaleTransactionController::class, 'create'])->name('minimarket.manage_transactions.create');
    Route::post('/minimarket/manage_transactions', [SaleTransactionController::class, 'store'])->name('minimarket.manage_transactions.store');
    Route::get('/minimarket/manage_transactions/{id}/edit', [SaleTransactionController::class, 'edit'])->name('minimarket.manage_transactions.edit');
    Route::match(['put', 'patch'],'/minimarket/manage_transactions/{id}', [SaleTransactionController::class, 'update'])->name('minimarket.manage_transactions.update');
    Route::delete('/minimarket/manage_transactions/{id}', [SaleTransactionController::class, 'destroy'])->name('minimarket.manage_transactions.destroy');
    Route::get('/get-brand-price/{brand}', [SaleTransactionController::class, 'getBrandPrice']);
});

Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/minimarket/Records/sale', [SaleRecordController::class, 'index'])->name('minimarket.Records.sale');
});


Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/minimarket/manage_transactions/report', [TransactionReportController::class, 'index'])->name('minimarket.manage_transactions.report');
});

Route::middleware(['role:Cashier|Owner|Supervisor'])->group(function () {
    Route::get('/get-discount/{discountName}', [DiscountController::class, 'getDiscount'])->name('get-discount');
    Route::get('/minimarket/manage_transactions/discount', [DiscountController::class, 'display'])->name('minimarket.manage_transactions.discount');
});


//Supervisor
Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/karyawan', [PenggunaController::class, 'index'])->name('minimarket.supervisor.karyawan');
});

Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/stock/index', [SupervisorController::class, 'index'])->name('minimarket.supervisor.stock.index');
});

Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/history/index', [TransactionHistoryController::class, 'index'])->name('minimarket.supervisor.history.index');
});

Route::middleware(['role:Supervisor'])->group(function () {
    Route::get('/minimarket/supervisor/history/report', [HistoryPurchaseTransactionController::class, 'index'])->name('minimarket.supervisor.history.report');
});


//Manager
Route::middleware(['role:Manager'])->group(function () {
    Route::get('/minimarket/manager/target', [TargetController::class, 'index'])->name('minimarket.manager.target');
    Route::get('/minimarket/manager/target/create', [TargetController::class, 'create'])->name('minimarket.manager.target.create');
    Route::post('/minimarket/manager/target', [TargetController::class, 'store'])->name('minimarket.manager.target.store');
    Route::get('/minimarket/manager/target/{id}/edit', [TargetController::class, 'edit'])->name('minimarket.manager.target.edit');
    Route::match(['put', 'patch'],'/minimarket/manager/target/{id}', [TargetController::class, 'update'])->name('minimarket.manager.target.update');
    Route::delete('/minimarket/manager/target/{id}', [TargetController::class, 'destroy'])->name('minimarket.manager.target.destroy');

});

Route::middleware(['role:Manager'])->group(function () {
    Route::get('/minimarket/manager/feedback', [FeedbackController::class, 'index'])->name('minimarket.manager.feedback');
    Route::match(['put', 'patch'], '/minimarket/manager/feedback/{id}', [FeedbackController::class, 'update'])->name('minimarket.manager.feedback.update');
    Route::get('/minimarket/manager/feedback/{id}/edit', [FeedbackController::class, 'edit'])->name('minimarket.manager.feedback.edit');
});

Route::middleware(['role:Manager'])->group(function () {
    Route::get('/minimarket/manager/stock', [StockController::class, 'index'])->name('minimarket.manager.stock');
});

Route::middleware(['role:Manager'])->group(function () {
    Route::get('/minimarket/manager/report/sales', [ReportManagerController::class, 'sale'])->name('minimarket.manager.report.sales');
    Route::get('/minimarket/manager/report/sales/print', [ReportManagerController::class, 'printsale'])->name('minimarket.manager.report.sales.print');
    Route::get('/minimarket/manager/report/purchase', [ReportManagerController::class, 'purchase'])->name('minimarket.manager.report.purchase');
    Route::get('/minimarket/manager/report/purchase/print', [ReportManagerController::class, 'printpurchase'])->name('minimarket.manager.report.purchase.print');
});

Route::middleware(['role:Manager'])->group(function () {
    Route::get('/minimarket/manager/karyawan', [EmployeeManagerController::class, 'index'])->name('minimarket.manager.karyawan');
});

Route::middleware(['role:Manager'])->group(function () {
    Route::get('/minimarket/manager/suppliers', [SupplierController::class, 'index'])->name('minimarket.manager.suppliers');
    Route::get('/minimarket/manager/suppliers/create', [SupplierController::class, 'create'])->name('minimarket.manager.suppliers.create');
    Route::post('/minimarket/manager/suppliers', [SupplierController::class, 'store'])->name('minimarket.manager.suppliers.store');
    Route::get('/minimarket/manager/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('minimarket.manager.suppliers.edit');
    Route::match(['put', 'patch'],'/minimarket/manager/suppliers/{id}', [SupplierController::class, 'update'])->name('minimarket.manager.suppliers.update');
    Route::delete('/minimarket/manager/suppliers/suppliers/{id}', [SupplierController::class, 'destroy'])->name('minimarket.manager.suppliers.destroy');
});

Route::middleware(['role:Manager'])->group(function () {
    Route::get('/get-discount/{discountName}', [DiscountController::class, 'getDiscount'])->name('get-discount');
    Route::get('/minimarket/manager/discount', [DiscountController::class, 'index'])->name('minimarket.manager.discount');
    Route::get('/minimarket/manager/discount/create', [DiscountController::class, 'create'])->name('minimarket.manager.discount.create');
    Route::post('/minimarket/manager/discount', [DiscountController::class, 'store'])->name('minimarket.manager.discount.store');
    Route::get('/minimarket/manager/discount/{id}/edit', [DiscountController::class, 'edit'])->name('minimarket.manager.discount.edit');
    Route::match(['put', 'patch'],'/minimarket/manager/discount/{id}', [DiscountController::class, 'update'])->name('minimarket.manager.discount.update');
    Route::delete('/minimarket/manager/discount/{id}', [DiscountController::class, 'destroy'])->name('minimarket.manager.discount.destroy');
});


//Owner
Route::middleware(['role:Owner'])->group(function () {
    Route::prefix('/minimarket/owner/employee')->group(function () {
        Route::get('/', [EmployeeOwnerController::class, 'index'])->name('minimarket.owner.employee');
        Route::get('/create', [EmployeeOwnerController::class, 'create'])->name('minimarket.owner.employee.create');
        Route::post('/store', [EmployeeOwnerController::class, 'store'])->name('minimarket.owner.employee.store');
        Route::get('/edit/{id}', [EmployeeOwnerController::class, 'edit'])->name('minimarket.owner.employee.edit');
        Route::put('/update/{id}', [EmployeeOwnerController::class, 'update'])->name('minimarket.owner.employee.update');
        Route::delete('/destroy/{id}', [EmployeeOwnerController::class, 'destroy'])->name('minimarket.owner.employee.destroy');
    });
});


Route::middleware(['role:Owner'])->group(function () {
    Route::prefix('/minimarket/owner')->group(function () {
        Route::get('/', [AllProductController::class, 'index'])->name('minimarket.owner');
    });
});

Route::middleware(['role:Owner'])->group(function () {
    Route::prefix('/minimarket/owner')->group(function () {
        Route::get('/feedback', [FeedbackOwnerController::class, 'index'])->name('minimarket.owner.feedback');
    });
});

Route::middleware(['role:Owner'])->group(function () {
    Route::prefix('/minimarket/owner')->group(function () {
        Route::get('/targetsales', [TargetSalesOwnerController::class, 'index'])->name('minimarket.owner.targetsales');
    });
});

Route::middleware(['role:Owner'])->group(function () {
    Route::prefix('/minimarket/owner')->group(function () {
        Route::get('/report/reportpurchase', [ReportOwnerController::class, 'purchase'])->name('minimarket.owner.report.reportpurchase');
        Route::get('/report/reportsales', [ReportOwnerController::class, 'sale'])->name('minimarket.owner.report.reportsales');
    });
});


require __DIR__.'/auth.php';
