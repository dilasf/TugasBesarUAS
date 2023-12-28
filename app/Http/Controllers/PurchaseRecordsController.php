<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRecord;

class PurchaseRecordsController extends Controller
{
    public function index()
    {
        $data['purchase_records'] = PurchaseRecord::with('supplier')->get();
        return view('minimarket.Records.purchase', $data);
    }

}
