<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\apprentis;
use Validator;

class ApprentisController extends Controller
{
    public function index()
    {
        return view('apprentis.ajouter');
    }

    public function submit(Request $request)
{
    // Validation rules
    $rules = [
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'civilite' => 'required',
        'nationalite' => 'required',
        'email' => 'required|email|max:255',
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
        'niveauscolaire' => 'required|string|max:255',
        'specialite' => 'required|string|max:255',
        'status' => 'required|string|max:255',
    ];

    // Custom error messages
    $messages = [
        'nom.required' => 'The name field is required.',
        'prenom.required' => 'The surname field is required.',
        'civilite.required' => 'The gender field is required.',
        'nationalite.required' => 'The nationality field is required.',
        'email.required' => 'The email field is required.',
        'telephone.required' => 'The telephone field is required.',
        'adresse.required' => 'The address field is required.',
        'niveauscolaire.required' => 'The level of study field is required.',
        'specialite.required' => 'The specialty field is required.',
        'status.required' => 'The status field is required.',
        'email.email' => 'The email must be a valid email address.',
        'telephone.numeric' => 'The telephone must be a valid number.',
    ];

    // Validate the incoming request
    $validator = Validator::make($request->all(), $rules, $messages);

    // If validation fails, return with errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // If validation passes, store the data
    try {
        $apprenti = new apprentis();
        $apprenti->fill($request->all());
        $apprenti->save();
        return redirect('/')->with('success', 'Apprenti ajouté avec succès');
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Une erreur est survenue: ' . $e->getMessage());
    }
}
}
