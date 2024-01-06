<?php

namespace App\Http\Controllers;

use App\Models\PurchaseTransaction;
use App\Models\SaleTransaction;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportManagerController extends Controller
    {
        public function sale()
        {
           $user = Auth::user();

        $dailyReports = SaleTransaction::where('sale_transactions.branch_id', $user->branch_id)
            ->selectRaw('
                DATE(sale_transactions.transaction_date) as date,
                COUNT(*) as totalTransactions,
                SUM(sale_transactions.total_price) as totalRevenue,
                SUM(products.stock) as initialStock,
                SUM(sale_transactions.quantity) as quantitySold,
                (SUM(products.stock) - SUM(sale_transactions.quantity)) as remainingStock
            ')
            ->join('products', 'sale_transactions.product_id', '=', 'products.id')
            ->groupBy('date')
            ->get();

        $totalTransactions = $dailyReports->sum('totalTransactions');
        $totalRevenue = $dailyReports->sum('totalRevenue');
        $totalInitialStock = $dailyReports->sum('initialStock');
        $totalQuantitySold = $dailyReports->sum('quantitySold');
        $totalRemainingStock = $dailyReports->sum('remainingStock');

        return view('minimarket.manager.report.sales.index', [
            'dailyReports' => $dailyReports,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'totalInitialStock' => $totalInitialStock,
            'totalQuantitySold' => $totalQuantitySold,
            'totalRemainingStock' => $totalRemainingStock,
        ]);
        }


    public function printsale()
    {
        $user = Auth::user();

        $dailyReports = SaleTransaction::where('sale_transactions.branch_id', $user->branch_id)
            ->selectRaw('
                DATE(sale_transactions.transaction_date) as date,
                COUNT(*) as totalTransactions,
                SUM(sale_transactions.total_price) as totalRevenue,
                SUM(products.stock) as initialStock,
                SUM(sale_transactions.quantity) as quantitySold
            ')
            ->join('products', 'sale_transactions.product_id', '=', 'products.id')
            ->groupBy('date')
            ->get();

        $totalTransactions = $dailyReports->sum('totalTransactions');
        $totalRevenue = $dailyReports->sum('totalRevenue');
        $totalInitialStock = $dailyReports->sum('initialStock');
        $totalQuantitySold = $dailyReports->sum('quantitySold');

        $pdf = FacadePdf::loadView('minimarket.manager.report.sales.print', [
            'dailyReports' => $dailyReports,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'totalInitialStock' => $totalInitialStock,
            'totalQuantitySold' => $totalQuantitySold,
        ]);


        return $pdf->download('sales_report.pdf');
    }


    public function purchase()
    {
        $user = Auth::user();

        $dailyReports = PurchaseTransaction::where('branch_id', $user->branch_id)
            ->selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(quantity) as totalStock, SUM(total_amount) as totalRevenue')
            ->groupBy('date')
            ->get();

        if ($dailyReports->isNotEmpty()) {
            $initialStock = DB::table('products')
                ->where('branch_id', $user->branch_id)
                ->where('created_at', '<', $dailyReports->first()->date)
                ->sum('stock');
        } else {
            $initialStock = 0;
        }

        $totalRevenue = PurchaseTransaction::where('branch_id', $user->branch_id)
            ->sum('total_amount');

        $totalTransactions = $dailyReports->sum('totalTransactions');

        return view('minimarket.manager.report.purchase.index', [
            'dailyReports' => $dailyReports,
            'initialStock' => $initialStock,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
        ]);
    }

    public function printpurchase()
{
    $user = Auth::user();

    $dailyReports = PurchaseTransaction::where('purchase_transactions.branch_id', $user->branch_id)
        ->selectRaw('
            DATE(purchase_transactions.transaction_date) as date,
            SUM(products.stock) as initialStock,
            SUM(purchase_transactions.quantity) as quantityPurchased,
            COUNT(*) as totalTransactions,
            SUM(purchase_transactions.total_amount) as totalRevenue
        ')
        ->join('products', 'purchase_transactions.product_id', '=', 'products.id')
        ->groupBy('date')
        ->get();

    $totalTransactions = $dailyReports->sum('totalTransactions');
    $totalRevenue = $dailyReports->sum('totalRevenue');
    $totalInitialStock = $dailyReports->sum('initialStock');
    $totalQuantityPurchased = $dailyReports->sum('quantityPurchased');

    $pdf = FacadePdf::loadView('minimarket.manager.report.purchase.print', [
        'dailyReports' => $dailyReports,
        'totalTransactions' => $totalTransactions,
        'totalRevenue' => $totalRevenue,
        'totalInitialStock' => $totalInitialStock,
        'totalQuantityPurchased' => $totalQuantityPurchased,
    ]);

    return $pdf->download('purchase_report.pdf');
}
}
