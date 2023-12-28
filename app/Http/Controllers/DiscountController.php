<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $data['discounts'] = Discount::all();
        return view('minimarket.manage_transactions.discount.index', $data);
    }

    public function create()
    {
        return view('minimarket.manage_transactions.discount.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'discount_name' => 'required|string|max:255',
            'discount_percent' => 'required|numeric|between:0,100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $discount = Discount::create($validatedData);

        if ($discount) {
            return redirect()->route('minimarket.manage_transactions.discount')
                ->with('success', 'Discount created successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.discount.create')
                ->with('error', 'Failed to create discount. Please try again.');
        }
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);

        return view('minimarket.manage_transactions.discount.edit', compact('discount'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'discount_name' => 'required|string|max:255',
            'discount_percent' => 'required|numeric|between:0,100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $discount = Discount::findOrFail($id);

        $discount->update($validatedData);

        if ($discount) {
            return redirect()->route('minimarket.manage_transactions.discount')
                ->with('success', 'Discount updated successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.discount.edit', $id)
                ->with('error', 'Failed to update discount. Please try again.');
        }
    }



    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        if ($discount->delete()) {
            return redirect()->route('minimarket.manage_transactions.discount')
                ->with('success', 'Discount deleted successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.discount.index')
                ->with('error', 'Failed to delete discount. Please try again.');
        }
    }

    public function getDiscount($discountName)
    {
        $discount = Discount::where('discount_name', $discountName)->first();

        if ($discount) {
            return response()->json([
                'discount_percent' => $discount->discount_percent,
            ]);
        } else {
            return response()->json([
                'discount_percent' => 0,
            ]);
        }
    }

    }

