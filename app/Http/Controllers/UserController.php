<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function profile()
    {
        return view('frontend.profile', ['user' => Auth::user()]);
    }

    // Backend Classes 

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:Guest,Manager,Admin'], // Validate role input
        ]);

         // Determine profile image based on role (without using asset())
         $profileImage = match ($request->role) {
            'Admin' => 'uploads/admin.png',
            'Guest' => 'uploads/guest.png',
            'Manager' => 'uploads/manager.png',
        };

       // Create the user with the provided data
       $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role, // Assign the role
        'profile_image' => $profileImage, // Assign profile image based on role
    ]);

    return redirect()->route('users.index')->with('success', 'User added successfully.');
    }


    public function index()
    {

        $users = User::all();

        return view('backend.users.index', compact('users'));
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'role' => 'required|string',
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'username' => $request->username,
        'role' => $request->role,
    ]);

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

}
