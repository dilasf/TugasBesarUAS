<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $userBranchId = auth()->user()->branch_id;
        $data['products'] = Product::where('branch_id', $userBranchId)->with('typesofgoods', 'units')->get();
        return view('minimarket.supervisor.stock.index', $data);
    }
}
