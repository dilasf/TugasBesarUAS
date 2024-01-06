<?php

namespace App\Http\Controllers;

use App\Models\MonthlySalesReport;
use App\Models\SaleTransaction;
use Illuminate\Support\Facades\Auth;

class TransactionReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dailyReports = SaleTransaction::where('branch_id', $user->branch_id)
            ->selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(total_price) as totalRevenue')
            ->groupBy('date')
            ->get();

        return view('minimarket.manage_transactions.report', [
            'dailyReports' => $dailyReports,
        ]);
    }
}
