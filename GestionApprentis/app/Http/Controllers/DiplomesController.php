<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\diplomes;
use Validator;
class DiplomesController extends Controller
{
    public function index()
    {
        return view('diplomes.ajouter');
    }

    public function submit(Request $request)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'duree' => 'required|int',
        ];

        $messages = [
            'nom.required' => 'The name field is required.',
            'duree.required' => 'The duration field is required.',
            'duree.integer' => 'The duration must be an integer.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $diplomes = new diplomes();
            $diplomes->nom = $request->input('nom');
            $diplomes->duree = $request->input('duree');
            $diplomes->save();
            return redirect()->route('diplomes.ajouter')->with('success', 'Diplome ajoute avec succes.');
        }

    }

}
