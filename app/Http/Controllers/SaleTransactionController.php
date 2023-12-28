<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\SaleRecord;
use App\Models\SaleTransaction;
use Illuminate\Http\Request;

class SaleTransactionController extends Controller
{
    public function index()
    {
        $data['products'] = Product::all();
        return view('minimarket.manage_transactions.index', $data);
    }

    public function create()
    {
        $payments = Payment::pluck('name', 'id');
        $paymentstatus = PaymentStatus::pluck('name', 'id');

        return view('minimarket.manage_transactions.create', [
            'payments' => $payments,
            'paymentstatus' => $paymentstatus,

        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_sale' => 'required|unique:sale_transactions,code_sale',
            'transaction_date' => 'required|date',
            'product_name' => 'required|string',
            'sale_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'tax_amount' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'discount_name' => 'nullable|string',
            'total_price_after_discount' => 'required|numeric|min:0',
            'payment_id' => 'required|exists:payments,id',
            'total_payment' => 'required|numeric|min:0',
            'change_amount' => 'required|numeric|min:0',
            'payment_status_id' => 'required|exists:payment_statuses,id',
            'discount_id' => 'nullable|exists:discounts,id',
        ]);

        $product = Product::where('product_name', $validated['product_name'])->first();

        if (!$product) {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Product not found';
            return redirect()->route('minimarket.manage_transactions.create')->withInput()->with($notification);
        }

        if ($product->stock < $validated['quantity']) {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Insufficient product stock';
            return redirect()->route('minimarket.manage_transactions.create')->withInput()->with($notification);
        }

        $validated['product_id'] = $product->id;

        if (isset($validated['discount_name']) && $validated['discount_name'] !== '-') {
            $discount = Discount::firstOrCreate(['discount_name' => $validated['discount_name']]);
            $validated['discount_id'] = $discount->id;
        } else {
            $validated['discount_id'] = null;
            $validated['discount_percent'] = null;
        }

        $transaction = SaleTransaction::create($validated);

        if ($transaction) {
            $product->stock -= $validated['quantity'];
            $product->save();

            SaleRecord::create([
                'code_sale' => $validated['code_sale'],
                'transaction_date' => $validated['transaction_date'],
                'product_name' => $validated['product_name'],
                'quantity' => $validated['quantity'],
                'sale_price' => $validated['sale_price'],
                'discount_name' => $validated['discount_name'],
                'total_price' => $validated['total_price'],
                'product_id' => $validated['product_id'],
                'discount_id' => $validated['discount_id'],
            ]);

            $notification['alert-type'] = 'success';
            $notification['message'] = 'Transaction Successful';
            return redirect()->route('minimarket.manage_transactions.create')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Transaction failed';
            return redirect()->route('minimarket.manage_transactions.create')->withInput()->with($notification);
        }
    }

    public function getProductPrice($productName)
{
    $product = Product::where('product_name', $productName)->first();

    if ($product) {
        return response()->json(['selling_price' => $product->selling_price]);
    } else {
        return response()->json(['error' => 'Product not found'], 404);
    }
}

}
