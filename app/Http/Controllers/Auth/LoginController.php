<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo;

  

    /**
     * Override the default login to add CNIC and CAPTCHA validation.
     */
    public function login(Request $request)
    {
        $request->validate([
            'cnic' => 'required|string',
            'password' => 'required|string',
            'captcha' => [
                'required',
                function ($attribute, $value, $fail) {
                    $stored = Session::pull('captcha_code');
                    if (!$stored || strtolower($value) !== strtolower($stored)) {
                        $fail('The CAPTCHA is incorrect or has expired.');
                    }
                }
            ],
        ]);

        if (Auth::attempt($request->only('cnic', 'password'), $request->filled('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors([
            'cnic' => 'These credentials do not match our records.',
        ])->withInput($request->only('cnic'));
    }

    /**
     * Redirect users based on role and verification.
     */
    public function redirectTo()
    {
        $user = Auth::user();

        if ($user->verify == '1') {
            switch ($user->role) {
                case 1:
                    return '/pmaform';
                case 2:
                    return '/Institute-dashboard';
                case 3:
                    return '/headinstitutedashboard';
                case 4:
                    return '/pmadashboard';
                default:
                    return '/login';
            }
        }

        return '/verify';
    }

    /**
     * Override default field used for authentication.
     */
    public function username()
    {
        return 'cnic';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
