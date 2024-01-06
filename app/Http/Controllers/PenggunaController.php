<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;

class PenggunaController extends Controller
{
    public function index()
    {
        $userBranchId = auth()->user()->branch_id;

        $data['users'] = User::where('branch_id', $userBranchId)
            ->with('positions')
            ->get();

        return view('minimarket.supervisor.karyawan.index', $data);
    }

}
