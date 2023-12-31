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
        $payments = Payment::pluck('name', 'id');
        $paymentstatus = PaymentStatus::pluck('name', 'id');

        return view('Supervisor.supervisor_riwayat_transaksi.create', [
            'payments' => $payments,
            'paymentstatus' => $paymentstatus,
        ]);
    }

    public function showHistory(Request $request)
    {
        // Mendapatkan bulan dan tahun yang dipilih dari request
        $selectedMonth = $request->input('selectedMonth');
        $selectedYear = $request->input('selectedYear');

        // Lakukan filter terhadap data transaksi berdasarkan bulan dan tahun yang dipilih
        $purchase_records = SaleTransaction::whereMonth('transaction_date', $selectedMonth)
            ->whereYear('transaction_date', $selectedYear)
            ->get();

        // Kirim data ke view riwayat transaksi yang telah difilter
        return view('Supervisor.supervisor_riwayat_transaksi.index', ['purchase_records' => $purchase_records]);
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
