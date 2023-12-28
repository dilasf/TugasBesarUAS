<?php

namespace App\Http\Controllers;

use App\Models\SaleTransaction;

class TransactionReportController extends Controller
{

        public function index()
        {

            $dailyReports = SaleTransaction::selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(total_price) as totalRevenue')
            ->groupBy('date')
            ->get();

        return view('minimarket.manage_transactions.report', [
            'dailyReports' => $dailyReports,
        ]);
    }
}

