<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRecord;
use App\Models\Supplier;
use App\Models\Typesofgood;
use App\Models\Unit;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::with('typesofgoods', 'units')->get();
        return view('minimarket.manage_goods.index', $data);
    }

    public function edit(string $id)
    {
        $barang= Product::find($id);
        $units = Unit::pluck('name', 'id');
        $typesofgoods = Typesofgood::pluck('name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');

        return view('minimarket.manage_goods.edit', [
            'units' => $units,
            'typesofgoods' => $typesofgoods,
            'suppliers' => $suppliers,
            'barang' => $barang,
        ]);
    }


        public function update(Request $request, string $id)
        {

            $data['products'] = Product::find($id);

            $validated = $request->validate([
                'code_product' => 'required|max:10',
                'product_name' => 'required|max:150',
                'type_id' => 'required|exists:typesofgoods,id',
                'unit_id' => 'required|exists:units,id',
                'brand' => 'required|max:100',
                'stock' => 'required|integer|min:1',
                'buying_price' => 'required|numeric|min:0',
                'selling_price' => 'required|numeric|min:0',
            ]);

            $product = Product::where('id', $id)->update($validated);

            if ($product) {
                return redirect()->route('minimarket.manage_goods')
                    ->with('success', 'Product updated successfully.');
            } else {
                return redirect()->route('minimarket.manage_goods.edit', $id)
                    ->with('error', 'Failed to update product. Please try again.');
            }
        }

        public function destroy(string $id)
        {
            $barang = Product::findOrFail($id);

            PurchaseRecord::where('product_id', $id)->update(['product_id' => null]);

            if ($barang->delete()) {
                return redirect()->route('minimarket.manage_goods')
                    ->with('success', 'Product deleted successfully.');
            } else {
                return redirect()->route('minimarket.manage_goods')
                    ->with('error', 'Failed to delete product. Please try again.');
            }
        }

}
