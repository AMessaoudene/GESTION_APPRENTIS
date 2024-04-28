<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\structures;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $structures = structures::all();
        return view('auth.register', compact('structures'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'civilite' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
            'structures_id' => ['required'], // Make sure this field is provided
        ]);

        $user = User::create([
            'nom' => $request->name,
            'prenom' => $request->prenom,
            'civilite' => $request->civilite,
            'email' => $request->email,
            'role' => $request->role,
            'structures_id' => $request->structures_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on user role
         switch ($user->role) {
            case 'DFP':
                return redirect()->route('dfp.dashboard');
                break;
            case 'SA':
                return redirect()->route('sa.dashboard');
                break;
            case 'DRH':
                return redirect()->route('drh.dashboard');
                break;
            case 'EvaluateurGradé':
                return redirect()->route('evaluateurgrade.dashboard');
                break;
            default:
                return redirect()->route('dashboard');
        }
    }
}
