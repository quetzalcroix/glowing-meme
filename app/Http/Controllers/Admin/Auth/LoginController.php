<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // use AuthenticatesUsers;
    /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating admin users for the application and
        | redirecting them to your admin dashboard.
        |
        */
    /**
     * This trait has all the login throttling functionality.
     */
    // use ThrottlesLogins;
    /**
     * Show the login form.
     * @return Application|Factory|View
     */
    public function showLoginForm()
    {
        return view('auth.adminlogin', [
          'title' => 'Admin Login', 'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }

    /**
     * Login the admin.
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function adminLogin(Request $request)
    {
        //$this->validator($request);
        $data = $this->validate($request, [
          'email' => 'required|email|exists:admins|min:5|max:191', 'password' => 'required|string|min:4|max:255',
        ]);
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'active'])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->withErrors([
          'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function validate_admin(): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended(route('admin.dashboard'))->with('message', 'You are Logged in as Admin!');
        } else {
            return redirect()->route('adminLoginForm')->with('message', 'Not allowed');
        }
    }

    /**
     * Logout the admin.
     * @return RedirectResponse
     */
    public function adminlogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('adminLoginForm')->with('status', 'Admin has been logged out!');
    }
}
