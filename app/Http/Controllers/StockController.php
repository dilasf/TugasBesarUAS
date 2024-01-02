<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        return view('minimarket.supervisor.stock.index', $data);
    }
}
