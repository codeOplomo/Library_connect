<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session; // Import the Session facade
use Illuminate\Support\Facades\Auth; // Import the Auth facade



class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/userhome'; // Change the redirect path as needed

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }



  // Handle the login POST request
  public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        session()->flash('success', 'Login successful'); 
        return redirect('/userhome')->with('success', 'Login successful'); 
    } else {
        session()->flash('error', 'Invalid credentials'); 
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}

  
}