<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the registration form inputs
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'Your name is required.',
            'email.required' => 'An email address is required.',
            'email.unique' => 'This email is already registered, please use a different one.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Create the user in the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Trigger the Registered event (useful for sending welcome emails or analytics tracking)
        event(new Registered($user));

        // Log the user in automatically after registration
        Auth::login($user);

        // Redirect to the home page with a success message
        return redirect()->route('home')->with('success', 'Registration successful! Welcome to Doc Pro.');
    }
}
