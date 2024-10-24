<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the username and password fields
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);


        // Attempt to log in using the username and password
        // if (Auth::attempt(['username' => trim($request->username), 'password' => trim($request->password)])) {
        if (Auth::guard('teacher')->attempt(['username' => trim($request->username), 'password' => trim($request->password)])) {

            // If successful, redirect to the intended route (e.g., the teacher's portal)
            return redirect()->intended('/teacher/home');
        }else {
            \Log::info('Authentication failed for user: ' . $request->username);
        }        

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['login_error' => 'Invalid Username or Password.']);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
