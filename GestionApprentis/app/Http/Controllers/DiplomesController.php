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
            'description'=>'nullable|string|max:2000',
        ];

        $messages = [
            'nom.required' => 'The name field is required.',
            'duree.required' => 'The duration field is required.',
            'duree.integer' => 'The duration must be an integer.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 2000 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $diplomes = new diplomes();
            $diplomes->nom = $request->input('nom');
            $diplomes->duree = $request->input('duree');
            $diplomes->description = $request->input('description');
            $diplomes->save();
            return redirect()->back();
        }
    }
}
