<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\SaleTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller {
    public function index()
    {
        $data['products'] = Product::all();
        return view('minimarket.supervisor.stock.index', $data);
    }


    public function create()
{
    $user = Auth::user();
    $payments = Payment::pluck('name', 'id');
    $paymentstatus = PaymentStatus::pluck('name', 'id');

    return view('minimarket.supervisor.history.create', [
        'payments' => $payments,
        'paymentstatus' => $paymentstatus,
        'branch_id' => $user->branch_id,
    ]);
}

    public function showHistory(Request $request)
    {
        $selectedMonth = $request->input('selectedMonth');
        $selectedYear = $request->input('selectedYear');

        $purchase_records = SaleTransaction::whereMonth('transaction_date', $selectedMonth)
            ->whereYear('transaction_date', $selectedYear)
            ->get();

        return view('minimarket.supervisor.history', ['purchase_records' => $purchase_records]);

        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id' ,
            'sale_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'tax_amount' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'total_price_after_discount' => 'required|numeric|min:0',
            'total_payment' => 'required|numeric|min:0',
            'change_amount' => 'required|numeric|min:0',
            'code_purchase' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'code_product' => 'required|numeric|min:0',
            'product_name' => 'required|string',
            'brand' => 'required|string',
            'stock' => 'required|numeric|min:0',
        ]);
    }

    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (!Auth::user()->hasRole('supervisor')) {
    //             abort(403, 'Unauthorized action.');
    //         }

    //         return $next($request);
    //     });
    // }
}
