<?php

namespace App\Http\Controllers;

use App\Models\SaleRecord;

class SaleRecordController extends Controller
{

    public function index()
    {
        $userBranchId = auth()->user()->branch_id;

        $data['sale_records'] = SaleRecord::where('branch_id', $userBranchId)
            ->with('product')
            ->get();

        return view('minimarket.Records.sale', $data);
    }
}
