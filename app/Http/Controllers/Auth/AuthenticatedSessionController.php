<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Branch;
use App\Models\Position;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $positions = Position::all();
        $branches = Branch::all();
        // return view('auth.login');
        return view('auth.login', compact('positions', 'branches'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password', 'position', 'branch');

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return redirect()->route('login')->withErrors([
                'name' => trans('auth.failed'),
            ]);
        }

        $user = Auth::user();

        // Gunakan Query Builder untuk menyimpan waktu login terakhir
        DB::table('users')->where('id', $user->id)->update(['last_login_at' => now()]);

        $request->session()->regenerate();

        $position = $user->position;

        if ($position === 'warehouse_staff' || $position === 'cashier' || $position === 'supervisor'|| $position === 'manager'|| $position === 'owner') {
            return redirect()->route('dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
