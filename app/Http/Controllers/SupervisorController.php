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
        $userBranchId = auth()->user()->branch_id;
        $data['products'] = Product::where('branch_id', $userBranchId)->with('typesofgoods', 'units')->get();
        return view('minimarket.supervisor.stock.index', $data);
    }

}
