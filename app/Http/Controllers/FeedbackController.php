<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use App\Models\PurchaseTransaction;
use App\Models\SaleTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('minimarket.manager.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('minimarket.manager.feedback.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $feedback = Feedback::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'keterangan' => $request->keterangan,
            'branch_id' => auth()->user()->branch_id,
        ]);
    
        if ($feedback) {
            return redirect()->route('minimarket.manager.feedback')
                ->with('success', 'New feedback created successfully.');
        } else {
            return redirect()->route('minimarket.manager.feedback.create')
                ->with('error', 'Failed to create feedback. Please try again.');
        }
    }

    // public function edit($id)
    // {
    //     $feedback = Feedback::findOrFail($id);

    //     return view('minimarket.manager.feedback.edit', compact('feedback'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'jabatan' => 'required|string|max:255',
    //         'keterangan' => 'required|string',
    //     ]);

    //     $feedback = Feedback::findOrFail($id);

    //     $feedback->update($validatedData);

    //     if ($feedback) {
    //         return redirect()->route('minimarket.manager.feedback')
    //             ->with('success', 'Feedback updated successfully.');
    //     } else {
    //         return redirect()->route('minimarket.manager.feedback.edit', $id)
    //             ->with('error', 'Failed to update feedback. Please try again.');
    //     }
    // }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);

        if ($feedback->delete()) {
            return redirect()->route('minimarket.manager.feedback')
                ->with('success', 'Feedback deleted successfully.');
        } else {
            return redirect()->route('minimarket.manager.feedback.index')
                ->with('error', 'Failed to delete feedback. Please try again.');
        }
    }
}
