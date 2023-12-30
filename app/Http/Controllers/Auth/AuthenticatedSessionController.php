<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Branch;
use App\Models\Position;
use App\Providers\RouteServiceProvider;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        // $credentials['position'] = $request->input('position');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            return redirect()->route('login')->withErrors([
                'name' => trans('auth.failed'),
            ]);
        }

        $user = Auth::user();


        $request->session()->regenerate();

        $user = Auth::user();
        $position = $user->position;

        if ($position === 'warehouse_staff' || $position === 'cashier' || $position === 'supervisor') {
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
