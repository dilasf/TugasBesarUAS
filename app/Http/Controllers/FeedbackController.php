<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Position;
use App\Models\Product;
use App\Models\PurchaseTransaction;
use App\Models\SaleTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $userBranchId = Auth::user()->branch_id;

        $positions = Position::whereIn('name', ['Chasier', 'Warehouse Staff', 'Supervisor'])->get();
        $positionIds = $positions->pluck('id')->all();

        $usersWithFeedback = User::where('branch_id', $userBranchId)
            ->whereIn('position_id', $positionIds)
            ->get();


        return view('minimarket.manager.feedback.index', compact('usersWithFeedback'));
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $userPositions = Position::pluck('name', 'id');

        return view('minimarket.manager.feedback.edit', compact('user', 'userPositions'));
    }

    public function update(Request $request, $userId)
    {
        $request->validate([
            'feedback' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($userId);
        $user->feedback = $request->input('feedback');
        $user->save();

        if ($user) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Feedback added successfully';
            return redirect()->route('minimarket.manager.feedback')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to added Feedback';
            return redirect()->route('minimarket.manager.feedback.edit')->withInput()->with($notification);
        }

    }

}
