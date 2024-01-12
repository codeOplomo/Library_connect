<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/register';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data) // Ensure you have this method
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role_id' => 2, // Assign the role ID here
        'phone' => $data['phone'],
    ]);

    return $user; // Return the user instance (or null if creation fails)
}


public function register(Request $request)
{
    $this->validator($request->all())->validate();

    $user = $this->create($request->all());

    if ($user) {
        return redirect(route('login'))->with('success', 'Registration successful! You can now log in.');
    } else {
        return redirect(route('register'))->with('error', 'Registration failed. Please try again.');
    }
}



protected function registered(Request $request, $user)
{
    return redirect(route('login'))->with('success', 'Registration successful! You can now log in.');
}


}
