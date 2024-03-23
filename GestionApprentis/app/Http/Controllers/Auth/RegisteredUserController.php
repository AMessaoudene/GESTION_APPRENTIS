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
     * Handle the first part of registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeFirstPart(Request $request): RedirectResponse
    {
        $request->validate([
            'structure_id' => ['required', 'exists:structures,id'], // Assuming you have a 'structures' table
            'role' => ['required', 'string'], // Add any validation rules for role
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'structure_id' => $request->structure_id,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Attach the structure to the user
        $user->structures()->attach($request->structure_id);

        // Store additional information in session to use in the completion part
        session()->put('user_id', $user->id);

        return redirect()->route('auth.completion'); // Assuming you have a route named 'auth.completion'
    }

    /**
     * Display the registration view for the second part.
     */
    public function createCompletion(): View
    {
        return view('auth.completion');
    }

    /**
     * Handle the second part of registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeCompletion(Request $request): RedirectResponse
    {
        $request->validate([
            'adresse_courriel' => ['required', 'string'], // Add any validation rules for adresse_courriel
            'nomresponsable' => ['required', 'string'],
            'prenomresponsable' => ['required', 'string'],
            'civilite' => ['required', 'string'],
            'numfixe' => ['required', 'string'],
        ]);

        // Retrieve user ID from session
        $userId = session()->get('user_id');

        $user = User::findOrFail($userId);

        // Update user with additional details
        $user->update([
            'adresse_courriel' => $request->adresse_courriel,
            'nomresponsable' => $request->nomresponsable,
            'prenomresponsable' => $request->prenomresponsable,
            'civilite' => $request->civilite,
            'numfixe' => $request->numfixe,
        ]);

        // Remove session data
        session()->forget('user_id');

        return redirect(route('dashboard', absolute: false));
    }
}
