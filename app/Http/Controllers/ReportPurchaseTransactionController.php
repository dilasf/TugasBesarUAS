<?php

namespace App\Http\Controllers;

use App\Models\PurchaseTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportPurchaseTransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dailyReports = PurchaseTransaction::where('branch_id', $user->branch_id)
            ->selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(total_amount) as totalRevenue')
            ->groupBy('date')
            ->get();

        return view('minimarket.manage_goods.report', [
            'dailyReports' => $dailyReports,
        ]);
    }

}
