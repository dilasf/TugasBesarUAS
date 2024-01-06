<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PurchaseTransaction;
use App\Models\SaleTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportOwnerController extends Controller
{
    public function purchase()
    {
        $branches = Branch::all();
        $user = Auth::user();

        $branchReports = [];

        foreach ($branches as $branch) {
            $branchName = $branch->name;

            $dailyReports = PurchaseTransaction::where('branch_id', $branch->id)
                ->selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(total_amount) as totalRevenue')
                ->groupBy('date')
                ->get();

            $branchReports[] = [
                'branchName' => $branchName,
                'dailyReports' => $dailyReports,
                'totalTransactions' => $dailyReports->sum('totalTransactions'),
                'totalRevenue' => $dailyReports->sum('totalRevenue'),
            ];
        }

        return view('minimarket.owner.report.reportpurchase', compact('branchReports'));
    }

    public function sale()
    {
        $user = Auth::user();
        $branches = Branch::all();

        $branchReports = [];

        foreach ($branches as $branch) {
            $dailyReports = SaleTransaction::where('branch_id', $branch->id)
                ->selectRaw('DATE(transaction_date) as date, COUNT(*) as totalTransactions, SUM(total_price) as totalRevenue')
                ->groupBy('date')
                ->get();

            $totalTransactions = $dailyReports->sum('totalTransactions');
            $totalRevenue = $dailyReports->sum('totalRevenue');

            $branchReports[] = [
                'branchName' => $branch->name,
                'dailyReports' => $dailyReports,
                'totalTransactions' => $totalTransactions,
                'totalRevenue' => $totalRevenue,
            ];
        }

        return view('minimarket.owner.report.reportsales', [
            'branchReports' => $branchReports,
        ]);
    }
}
