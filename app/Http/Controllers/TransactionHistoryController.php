<?php

namespace App\Http\Controllers;

use App\Models\SaleTransaction;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dailyReports = SaleTransaction::where('branch_id', $user->branch_id)
            ->selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(total_price) as totalRevenue')
            ->groupBy('date')
            ->get();
        $totalTransactions = $dailyReports->sum('totalTransactions');
        $totalRevenue = $dailyReports->sum('totalRevenue');

        return view('minimarket.supervisor.history.index', [
            'dailyReports' => $dailyReports,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
        ]);
    }
}
