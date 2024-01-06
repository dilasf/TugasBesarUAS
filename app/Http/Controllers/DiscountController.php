<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $data['discounts'] = Discount::all();
        return view('minimarket.manager.discount.index', $data);
    }

    public function create()
    {
        return view('minimarket.manager.discount.create');
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
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Discount created successfully';
            return redirect()->route('minimarket.manager.discount')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to create discount';
            return redirect()->route('minimarket.manager.discount.create')->withInput()->with($notification);
        }
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);

        return view('minimarket.manager.discount.edit', compact('discount'));
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
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Discount updated successfully';
            return redirect()->route('minimarket.manager.discount')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to update discount';
            return redirect()->route('minimarket.manager.discount.edit')->withInput()->with($notification);
        }
    }



    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        if ($discount->delete()) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Discount deleted successfully';
            return redirect()->route('minimarket.manager.discount')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to delete discount';
            return redirect()->route('minimarket.manager.discount')->withInput()->with($notification);
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

    public function display()
    {
        $data['discounts'] = Discount::all();
        return view('minimarket.manage_transactions.discount.index', $data);
    }

    }

