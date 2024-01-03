<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class PenjualanController extends Controller
{
    public function index()
    {
        $data ['Penjualan'] = Penjualan::with('Nama barang','Kategori','Harga Jual', 'Harga Beli');
        return view('index', $data);
    }
    public function create()
    {
        return view('minimarket.manage_transactions.penjualan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'penjualan_name' => 'required|string|max:255',
            'penjualan_percent' => 'required|numeric|between:0,100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $penjualan = Penjualan::create($validatedData);

        if ($penjualan) {
            return redirect()->route('minimarket.manage_transactions.penjualan')
                ->with('success', 'Penjualan created successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.penjualan.create')
                ->with('error', 'Failed to create penjualan. Please try again.');
        }
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view('minimarket.manage_transactions.penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'penjualan_name' => 'required|string|max:255',
            'penjualan_percent' => 'required|numeric|between:0,100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update($validatedData);

        if ($penjualan) {
            return redirect()->route('minimarket.manage_transactions.penjualan')
                ->with('success', 'Penjualan updated successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.penjualan.edit', $id)
                ->with('error', 'Failed to update penjualan. Please try again.');
        }
    }



    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        if ($penjualan->delete()) {
            return redirect()->route('minimarket.manage_transactions.penjualan')
                ->with('success', 'Penjualan deleted successfully.');
        } else {
            return redirect()->route('minimarket.manage_transactions.penjualan.index')
                ->with('error', 'Failed to delete penjualan. Please try again.');
        }
    }

    public function getPenjualan($penjualanName)
    {
        $penjualan = Penjualan::where('penjualan_name', $penjualanName)->first();

        if ($penjualan) {
            return response()->json([
                'penjualan_percent' => $penjualan->penjualan_percent,
            ]);
        } else {
            return response()->json([
                'penjualan_percent' => 0,
            ]);
        }
    }
}
