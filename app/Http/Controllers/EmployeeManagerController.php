<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeManagerController extends Controller
{
    public function index()
    {
        $userBranchId = auth()->user()->branch_id;

        $data['users'] = User::where('branch_id', $userBranchId)
            ->with('positions')
            ->get();

        return view('minimarket.manager.karyawan.index', $data);
    }
}
