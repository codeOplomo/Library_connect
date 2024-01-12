<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('dashboard.dashuser', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'phone' => 'required|string',
        'role_id' => 'required|exists:roles,id',
    ]);

    // Handle image upload
    $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;

    
    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'image' => $imagePath,
        'phone' => $request->input('phone'),
        'role_id' => $request->input('role_id'),
    ]);
    

    return redirect()->route('dashuser')->with('success', 'User created successfully');
}



    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'phone' => 'required|string',
        'role_id' => 'required|exists:roles,id',
    ]);

    // Handle image upload
    $imagePath = $user->image;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    // Update only if password is provided
    $password = $request->filled('password') ? bcrypt($request->input('password')) : $user->password;

    $user->update([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $password,
        'image' => $imagePath,
        'phone' => $request->input('phone'),
        'role_id' => $request->input('role_id'),
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}


