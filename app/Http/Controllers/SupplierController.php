<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data['suppliers'] = Supplier::all();
        return view('minimarket.manage_goods.suppliers.index', $data);
    }

    public function create()
    {
        return view('minimarket.manage_goods.suppliers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $supplier = Supplier::create($validatedData);

        if ( $supplier) {
            return redirect()->route('minimarket.manage_goods.suppliers')
                ->with('success', 'Supplier created successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.discount.create')
                ->with('error', 'Failed to create supplier. Please try again.');
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('minimarket.manage_goods.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update($validatedData);

        if ( $supplier) {
            return redirect()->route('minimarket.manage_goods.suppliers')
                ->with('success', 'Supplier updated successfully.');
        } else {
            return redirect()->route('minimarket.manage_goods.suppliers.edit', $id)
                ->with('error', 'Failed to update supplier. Please try again.');
        }
    }



    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if ($supplier->delete()) {
            return redirect()->route('minimarket.manage_goods.suppliers')
                ->with('success', 'Supplier deleted successfully.');
        } else {
            return redirect()->route('minimarket.manage_goods.suppliers')
                ->with('error', 'Failed to delete supplier. Please try again.');
        }
    }
}
