<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\SaleRecord;
use App\Models\SaleTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SaleTransactionController extends Controller
{

    public function index()
    {
        $userBranchId = auth()->user()->branch_id;
        $data['products'] = Product::where('branch_id', $userBranchId)->with('typesofgoods', 'units')->get();
        return view('minimarket.manage_transactions.index', $data);
    }

    public function create()
    {
        $user = Auth::user();
        $payments = Payment::pluck('name', 'id');
        $paymentstatus = PaymentStatus::pluck('name', 'id');
        $discounts = Discount::all(['id', 'discount_name', 'discount_percent'])->mapWithKeys(function ($discount) {
            return [$discount->id => [
                'discount_name' => $discount->discount_name,
                'discount_percent' => $discount->discount_percent,
            ]];
        })->toArray();

        return view('minimarket.manage_transactions.create', [
            'payments' => $payments,
            'paymentstatus' => $paymentstatus,
            'branch_id' => $user->branch_id,
            'discounts' => $discounts,
        ]);
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'code_sale' => 'required|unique:sale_transactions,code_sale','code_sale,NULL,id,branch_id,' . $request->input('branch_id'),
            'transaction_date' => 'required|date',
            'brand' => 'required|string',
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

        $user = Auth::user();
        $validated['branch_id'] = $user->branch_id;

        $product = Product::where('brand', $validated['brand'])
        ->where('branch_id', $validated['branch_id'])
        ->first();

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

            $saleRecordData = [
                'branch_id' => $validated['branch_id'],
                'code_sale' => $validated['code_sale'],
                'transaction_date' => $validated['transaction_date'],
                'brand' => $validated['brand'],
                'quantity' => $validated['quantity'],
                'sale_price' => $validated['sale_price'],
                // 'discount_name' => $validated['discount_name'],
                'total_price' => $validated['total_price'],
                'product_id' => $validated['product_id'],
                'discount_id' => $validated['discount_id'],
            ];

            if (isset($validated['discount_name']) && $validated['discount_name'] !== '') {
                $saleRecordData['discount_name'] = $validated['discount_name'];
            }

            SaleRecord::create($saleRecordData);

            $notification['alert-type'] = 'success';
            $notification['message'] = 'Transaction Successful';
            return redirect()->route('minimarket.manage_transactions.create')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Transaction failed';
            return redirect()->route('minimarket.manage_transactions.create')->withInput()->with($notification);
        }
    }

    public function getBrandPrice($brand)
{
    $branchId = auth()->user()->branch_id;

    $product = Product::where('brand', $brand)
        ->where('branch_id', $branchId)
        ->first();

    if ($product) {
        return response()->json(['selling_price' => $product->selling_price]);
    } else {
        Log::error('Product not found for brand: ' . $brand . ' in branch: ' . $branchId);
        return response()->json(['error' => 'Product not found for the given branch and brand'], 404);
    }
}


}
