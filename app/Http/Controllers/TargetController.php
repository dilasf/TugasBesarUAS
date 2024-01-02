<?php

namespace App\Http\Controllers;

use App\Models\TargetSales;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function index()
    {
        $targets = TargetSales::all();
        return view('minimarket.manager.target.index', compact('targets'));
    }

    public function create()
    {
        return view('minimarket.manager.target.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bulan' => 'required|string|max:255',
            'target_penjualan' => 'required|numeric|between:0,999999.99', 
            'penjualan_aktual' => 'required|numeric|between:0,999999.99', 
            'selisih' => 'required|numeric|between:-999999.99,999999.99', 
        ]);

        $target = TargetSales::create([
            'bulan' => $request->bulan,
            'target_penjualan' => $request->target_penjualan,
            'penjualan_aktual' => $request->penjualan_aktual,
            'selisih' => $request->selisih,
            'manager_name' => auth()->user()->name,
            'branch_id' => auth()->user()->branch_id,
            'position_id' => auth()->user()->position_id,
        ]);
        
        if ($target) {
            return redirect()->route('minimarket.manager.target')
                ->with('success', 'New target created successfully.');
        } else {
            return redirect()->route('minimarket.manager.target.create')
                ->with('error', 'Failed to create target. Please try again.');
        }
    }

    public function edit($id)
    {
        $target = TargetSales::findOrFail($id);

        return view('minimarket.manager.target.edit', compact('target'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bulan' => 'required|string|max:255',
            'target_penjualan' => 'required|numeric|between:0,999999.99', 
            'penjualan_aktual' => 'required|numeric|between:0,999999.99', 
            'selisih' => 'required|numeric|between:-999999.99,999999.99', 
        ]);

        $target = TargetSales::findOrFail($id);

        $target->update($validatedData);

        if ($target) {
            return redirect()->route('minimarket.manager.target')
                ->with('success', 'Target updated successfully.');
        } else {
            return redirect()->route('minimarket.manager.target.edit', $id)
                ->with('error', 'Failed to update target. Please try again.');
        }
    }

    public function destroy($id)
    {
        $target = TargetSales::findOrFail($id);

        if ($target->delete()) {
            return redirect()->route('minimarket.manager.target')
                ->with('success', 'Target deleted successfully.');
        } else {
            return redirect()->route('minimarket.manager.target.index')
                ->with('error', 'Failed to delete target. Please try again.');
        }
    }
}