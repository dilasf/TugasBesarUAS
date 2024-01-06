<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Position;
use App\Models\TargetSales;
use Illuminate\Http\Request;
use App\Models\User;

class TargetSalesOwnerController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        $targetSalesByBranch = [];

        foreach ($branches as $branch) {
            $targetSalesByBranch[$branch->name]['manager'] = User::where('branch_id', $branch->id)
                ->where('position_id', Position::where('name', 'Manager')->first()->id)
                ->first();

            $targetSalesByBranch[$branch->name]['salesTargets'] = TargetSales::where('branch_id', $branch->id)->get();
        }

        return view('minimarket.owner.targetsales', compact('branches', 'targetSalesByBranch'));
    }
}
