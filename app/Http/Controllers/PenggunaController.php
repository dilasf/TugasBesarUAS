<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    public function index()
    {
        $userBranchId = auth()->user()->branch_id;
        $data['users'] = User::where('branch_id', $userBranchId)->with('positions')->get();
        return view('minimarket.enmployees.karyawan.index', $data);
    }

    public function create() 
{
    $positions = Position::pluck('name', 'id');

    return view('minimarket.enmployees.karyawan.create', ['positions' => $positions]);
    
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        // 'branch_id' => 'required|exists:branches,id',
        'name' => 'required|string|max:255',
        // 'position_name' => 'required|string|max:255',
        'position_id' => 'required|exists:positions,id',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $user = Auth::user();

    // Ensure branch_id is included in the creation process
    // $validatedData['branch_id'] = $user->branch_id;
    // $user = User::create($validatedData);

    return redirect()->route('minimarket.enmployees.index')->with('success', 'Pengguna berhasil ditambahkan');
}

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('minimarket.enmployees.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $userBranchId = auth()->user()->branch_id;
        $user['user'] = User::where('branch_id', $userBranchId)->find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'positions' => 'required|exists:positions,id',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:6',
        ]);
        $validated['branch_id'] = $userBranchId;
        $user = User::where('branch_id', $userBranchId)->where('id', $id)->update($validated);

        if($user) {
            $notification['alert-type'] = 'success';
            $notification['message'] = 'Data Pengguna Berhasil Di Update';
            return redirect()->route('minimarket.enmployees.index')->with($notification);
        }else{
            $notification['alert-type'] = 'error';
            $notification['message'] = 'Failed to Update Data Pengguna';
            return redirect()->route('minimarket.enmployees.edit');
        }
    }





    // public function delete(string $id)
    // {
    //     try {
    //         $userBranchId = auth()->user()->branch_id;
    //         $user = User::where('branch_id', $userBranchId)->findOrFail($id);
    
    //         Logs::where('user', $id)->update(['user' => null]);

    //         $deleted = $user->delete();
    
    //         if ($deleted) {
    //             $notification = [
    //                 'alert-type' => 'success',
    //                 'message' => 'Product Deleted Successfully'
    //             ];
    //             return redirect()->route('minimarket.manage_goods')->with($notification);
    //         } else {
    //             throw new \Exception('Failed to Delete Product');
    //         }
    //     } catch (\Exception $e) {
    //         $notification = [
    //             'alert-type' => 'error',
    //             'message' => $e->getMessage()
    //         ];
    //         return redirect()->route('minimarket.manage_goods')->with($notification);
    //     }
    // }
    


}
