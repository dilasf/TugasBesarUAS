<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseRecord;
use App\Models\Supplier;
use App\Models\Typesofgood;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $userBranchId = auth()->user()->branch_id;
        $data['products'] = Product::where('branch_id', $userBranchId)->with('typesofgoods', 'units')->get();
        return view('minimarket.manage_goods.index', $data);
    }

    public function edit(string $id)
    {
        $userBranchId = auth()->user()->branch_id;
        $barang = Product::where('branch_id', $userBranchId)->find($id);
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
        $userBranchId = auth()->user()->branch_id;
    $data['product'] = Product::where('branch_id', $userBranchId)->find($id);

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

        $validated['branch_id'] = $userBranchId;
        $product = Product::where('branch_id', $userBranchId)->where('id', $id)->update($validated);

        if ($product) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Product Successfully Updated';
            return redirect()->route('minimarket.manage_goods')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Update Product';
            return redirect()->route('minimarket.manage_goods.update')->withInput()->with($notification);
        }
    }

    public function destroy(string $id)
    {
        $userBranchId = auth()->user()->branch_id;
        $barang = Product::where('branch_id', $userBranchId)->findOrFail($id);

        PurchaseRecord::where('product_id', $id)->update(['product_id' => null]);

        $product = $barang->delete();

        if ($product) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Product Deleted Successfully';
            return redirect()->route('minimarket.manage_goods')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Delete Product';
            return redirect()->route('minimarket.manage_goods.update')->withInput()->with($notification);
        }
    }
}
