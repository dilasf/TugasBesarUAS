<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        $productsByBranch = [];
        foreach ($branches as $branch) {
            $products = Product::where('branch_id', $branch->id)
                ->with('purchaseTransactions', 'saleTransactions')
                ->get();

            foreach ($products as $product) {
                $product->total_purchases = $product->purchaseTransactions->sum('total_amount');
                $product->total_sales = $product->saleTransactions->sum('total_price');
                $product->profit_loss = $product->total_sales - $product->total_purchases;
                $product->profit_loss_percentage = ($product->profit_loss / ($product->total_purchases ?: 1)) * 100;
            }

            $productsByBranch[$branch->name] = $products;
        }

        return view('minimarket.owner.index', ['branches' => $branches, 'productsByBranch' => $productsByBranch]);
    }

}
