<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('minimarket.inmployees.index', ['users' => $users]); 
    }

}
