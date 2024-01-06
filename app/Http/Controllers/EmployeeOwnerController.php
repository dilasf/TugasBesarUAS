<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeOwnerController extends Controller
{
    public function index()
    {

        $branches = Branch::all();

        $usersByBranch = [];
        foreach ($branches as $branch) {
            $usersByBranch[$branch->name] = User::where('branch_id', $branch->id)->get();
        }

        return view('minimarket.owner.employee.index', ['branches' => $branches, 'usersByBranch' => $usersByBranch]);
    }

    public function create()
    {
        $branches = Branch::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');

        return view('minimarket.owner.employee.create', [
            'branches' => $branches,
            'positions' => $positions,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'position_id' => 'required|exists:positions,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        // $user = new User();
        // $user->name = $validatedData['name'];
        // $user->email = $validatedData['email'];
        // $user->password = bcrypt($validatedData['password']);
        // $user->position_id = $validatedData['position_id'];
        // $user->branch_id = $validatedData['branch_id'];
        // $user->save();
        $user = User::create($validatedData);
        if ($user) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Employee added successfully';
            return redirect()->route('minimarket.owner.employee')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to added Employee';
            return redirect()->route('minimarket.owner.employee.create')->withInput()->with($notification);
        }

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $branches = Branch::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');

        return view('minimarket.owner.employee.edit', compact('user', 'branches', 'positions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'position_id' => 'required|exists:positions,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->position_id = $validatedData['position_id'];
        $user->branch_id = $validatedData['branch_id'];
        $user->save();

        if ($user) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Employee updated successfully';
            return redirect()->route('minimarket.owner.employee')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to updated Employee';
            return redirect()->route('minimarket.owner.employee.edit')->withInput()->with($notification);
        }

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Employee deleted successfully';
            return redirect()->route('minimarket.owner.employee')->with($notification);
        } else {
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to deleted Employee';
            return redirect()->route('minimarket.owner.employee')->withInput()->with($notification);
        }
    }

}
