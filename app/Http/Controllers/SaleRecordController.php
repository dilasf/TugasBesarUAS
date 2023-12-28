<?php

namespace App\Http\Controllers;

use App\Models\SaleRecord;

class SaleRecordController extends Controller
{
    public function index()
    {
        $data['sale_records'] = SaleRecord::with('product')->get();
        return view('minimarket.Records.sale', $data);
    }
}
