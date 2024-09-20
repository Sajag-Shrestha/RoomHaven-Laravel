<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate registration data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
            'last_login' => now(),
        ]);

        // Trigger the Registered event
        event(new Registered($user));

        // Automatically log the user in
        Auth::login($user);

        // Redirect based on user role
        if ($user->role === 'Admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'Guest') {
            return redirect()->route('index');
        }

        // Default redirect (for Manager or any other role)
        return redirect()->route('dashboard');
    }
}
