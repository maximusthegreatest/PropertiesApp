<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest:admin', 'guest:web']);
    }


    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        //validate form data
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required|min:6'
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        //attempt to log the user in
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }
}
