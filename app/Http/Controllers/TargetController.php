<?php

namespace App\Http\Controllers;

use App\Models\SaleTransaction;
use App\Models\TargetSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TargetController extends Controller
{
    public function index()
    {
        $userBranchId = auth()->user()->branch_id;
        $targetSales = TargetSales::where('branch_id', $userBranchId)->get();

        return view('minimarket.manager.target.index', compact('targetSales'));
    }

    public function create()
    {
        return view('minimarket.manager.target.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'branch_id' => 'required|exists:branches,id',
        'bulan' => 'required|string',
        'target_penjualan' => 'required|numeric|min:0',
    ]);

    $user = Auth::user();
    $validated['branch_id'] = $user->branch_id;
    $validated['user_id'] = $user->id;

    $penjualanAktual = SaleTransaction::where('branch_id', $validated['branch_id'])
        ->whereMonth('transaction_date', now()->month)
        ->sum('total_price');

    $validated['penjualan_aktual'] = $penjualanAktual;
    $validated['selisih'] = $validated['target_penjualan'] - $penjualanAktual;

    $targetSale = TargetSales::updateOrCreate(
        ['branch_id' => $validated['branch_id'], 'bulan' => $validated['bulan']],
        $validated
    );

    if ($targetSale) {
        $notification['alert-type'] = 'success';
        $notification['message'] = 'Sales Target added successfully';
        return redirect()->route('minimarket.manager.target')->with($notification);
    } else {
        $notification['alert-type'] = 'error';
        $notification['message'] = 'Failed to added Sales Target';
        return redirect()->route('minimarket.manager.target.create')->withInput()->with($notification);
    }
}

    public function edit($id)
    {
        $targetSales = TargetSales::findOrFail($id);
        return view('minimarket.manager.target.edit', compact('targetSales'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bulan' => 'required|string',
            'target_penjualan' => 'required|numeric|min:0',
            'penjualan_aktual' => 'required|numeric|min:0',
        ]);

        $validated['selisih'] = $validated['target_penjualan'] - $validated['penjualan_aktual'];

        $targetSales = TargetSales::findOrFail($id);
        $targetSales->update($validated);

        if ($targetSales) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Sales Target updated successfully';
            return redirect()->route('minimarket.manager.target')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to updated Sales Target';
            return redirect()->route('minimarket.manager.target.edit')->withInput()->with($notification);
        }
    }

    public function destroy($id)
    {
        $targetSales = TargetSales::findOrFail($id);
        $targetSales->delete();

        if ($targetSales) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Sales Target deleted successfully';
            return redirect()->route('minimarket.manager.target')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to deleted Sales Target';
            return redirect()->route('minimarket.manager.target')->withInput()->with($notification);
        }
    }


}
