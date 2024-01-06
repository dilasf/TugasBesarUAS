<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackOwnerController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        $positions = Position::whereIn('name', ['Chasier', 'Warehouse Staff', 'Supervisor'])->get();
        $positionIds = $positions->pluck('id')->all();

        $feedbackByBranch = DB::table('users')
            ->join('branches', 'users.branch_id', '=', 'branches.id')
            ->whereIn('users.position_id', $positionIds)
            ->select('branches.name as branch_name', 'users.name', 'users.feedback')
            ->orderBy('branches.name')
            ->get()
            ->groupBy('branch_name');

        $managersByBranch = [];
        foreach ($branches as $branch) {
            $manager = User::where('branch_id', $branch->id)
                ->where('position_id', Position::where('name', 'Manager')->first()->id)
                ->first();

            if ($manager) {
                $managersByBranch[$branch->name] = $manager->name;
            }
        }

        return view('minimarket.owner.feedback', compact('feedbackByBranch', 'branches', 'managersByBranch'));
    }
}
