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
        // Points to your unified login/register page
        return view('auth.login'); 
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate Input
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'string', 'max:20', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()], 
            'address'  => ['nullable', 'string', 'max:500'],
        ]);

        // 2. Create the User
        // Note: 'email' is removed from here since your form doesn't have it.
        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'address'  => $request->address, 
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        // 3. Fire the Registered Event
        event(new Registered($user));

        // 4. Log the user in immediately
        Auth::login($user);

        // 5. Redirect to Home
        // I changed route('home') to '/' just to be safe. 
        // If your home route has a name, you can use redirect()->route('home');
        return redirect('/')->with('success', 'Welcome to Khmer Kitchen!');
    }
}