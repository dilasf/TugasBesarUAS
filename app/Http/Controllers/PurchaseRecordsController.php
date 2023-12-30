<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRecord;
use Illuminate\Support\Facades\Auth;

class PurchaseRecordsController extends Controller
{
    public function index()
    {
        $userBranchId = auth()->user()->branch_id;

        $data['purchase_records'] = PurchaseRecord::where('branch_id', $userBranchId)
            ->with('supplier')
            ->get();

        return view('minimarket.Records.purchase', $data);
    }
}
