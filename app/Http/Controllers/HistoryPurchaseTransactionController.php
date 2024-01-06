<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryPurchaseTransactionController extends Controller
{
    public function index()
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

        return view('minimarket.supervisor.history.report', [
            'dailyReports' => $dailyReports,
            'initialStock' => $initialStock,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
