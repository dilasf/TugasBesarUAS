<?php

namespace App\Http\Controllers;

use App\Models\SaleTransaction;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
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

        return view('minimarket.supervisor.history.index', [
            'dailyReports' => $dailyReports,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'totalInitialStock' => $totalInitialStock,
            'totalQuantitySold' => $totalQuantitySold,
            'totalRemainingStock' => $totalRemainingStock,
        ]);
    }
}
