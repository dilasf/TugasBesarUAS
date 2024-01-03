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
    $request->authenticate();

    $user = Auth::user();
    $position = $user->position;
    $branch = $user->branch;

    $credentials = $request->only('name', 'password', 'position', 'branch');

    // Check if the user has the correct position and branch
    if ($position === $credentials['position'] && $branch === $credentials['branch']) {
        // Code to be executed if the condition is true
        
        $request->session()->regenerate();

        if ($position === 'warehouse_staff' || $position === 'cashier' || $position === 'supervisor' || $position === 'manager') {
            return redirect()->route('dashboard');
        }
    }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    dd(session()->all());

    return redirect()->route('login')->withErrors([
        'name' => trans('auth.failed'),
    ]);
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
