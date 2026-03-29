<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the redirect path after login
     */
    public function redirectPath()
    {
        return redirect()->intended('/');
    }

    /**
     * Override logout redirect
     */
    protected function loggedOut(Request $request)
    {
        redirect()->route('/');
    }
}
