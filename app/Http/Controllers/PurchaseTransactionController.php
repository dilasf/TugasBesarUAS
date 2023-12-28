<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\PurchaseRecord;
use App\Models\PurchaseTransaction;
use App\Models\Supplier;
use App\Models\Typesofgood;
use App\Models\Unit;
use Illuminate\Http\Request;

class PurchaseTransactionController extends Controller
{
    public function create()
    {
        $products = Product::pluck('product_name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');
        $typesofgoods = Typesofgood::pluck('name', 'id');
        $units = Unit::pluck('name', 'id');
        $payment = Payment::pluck('name', 'id');

        return view('minimarket.manage_goods.transaction.create', [
            'products' => $products,
            'suppliers' => $suppliers,
            'typesOfGoods' => $typesofgoods,
            'units' => $units,
            'paymentMethods' => $payment,
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'code_purchase' => 'required|unique:purchase_transactions,code_purchase',
        'transaction_date' => 'required|date',
        'code_product' => 'required|string',
        'product_name' => 'required|string',
        'type_id' => 'required|exists:typesofgoods,id',
        'unit_id' => 'required|exists:units,id',
        'brand' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'supplier_name' => 'required|string',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'buying_price' => 'required|numeric|min:0',
        'total_amount' => 'required|numeric|min:0',
        'payment_method_id' => 'required|exists:payments,id',
        'product_id' => 'nullable|exists:products,id',
    ]);

    $supplier = Supplier::where('supplier_name', $validated['supplier_name'])->first();

    if (!$supplier) {
        $validated['supplier_id'] = null;
    } else {
        $validated['supplier_id'] = $supplier->id;
    }

    $existingProduct = Product::where([
        'code_product' => $validated['code_product'],
        'product_name' => $validated['product_name'],
        'type_id' => $validated['type_id'],
        'unit_id' => $validated['unit_id'],
        'brand' => $validated['brand'],
        'buying_price' => $validated['buying_price'],
    ])->first();

    $purchaseRecord = PurchaseRecord::create([
        'code_purchase' => $validated['code_purchase'],
        'code_product' => $validated['code_product'],
        'product_name' => $validated['product_name'],
        'quantity' => $validated['quantity'],
        'purchase_price' => $validated['total_amount'],
        'transaction_date' => $validated['transaction_date'],
        'supplier_name' => $validated['supplier_name'],
        'supplier_id' => $supplier ? $supplier->id : null,
        'product_id' => $existingProduct ? $existingProduct->id : null,  // Set product_id pada purchaseRecord
    ]);

    if ($existingProduct) {
        $existingProduct->stock += $validated['quantity'];
        $existingProduct->save();
    } else {
        $product = Product::create([
            'code_product' => $validated['code_product'],
            'product_name' => $validated['product_name'],
            'brand' => $validated['brand'],
            'type_id' => $validated['type_id'],
            'unit_id' => $validated['unit_id'],
            'stock' => $validated['quantity'],
            'buying_price' => $validated['buying_price'],
        ]);

        $purchaseRecord->product_id = $product->id;
        $purchaseRecord->save();
    }

    $transaction = PurchaseTransaction::create($validated);

    if ($transaction) {
        $notification['alert-type'] = 'success';
        $notification['message'] = 'Purchase Made Successfully';
        return redirect()->route('minimarket.manage_goods')->with($notification);
    } else {
        $notification['alert-type'] = 'error';
        $notification['message'] = 'Failed to Make Purchase';
        return redirect()->route('minimarket.manage_goods.transaction.create')->withInput()->with($notification);
    }
}
}
