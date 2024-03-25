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
    //afficher les details d'un diplome
    public function details($id){
        $diplome = diplomes::find($id);

        // Check if $diplome is null
        if (!$diplome) {
            // If the diplome with the given ID does not exist, redirect to an error page or return a message
            return redirect()->route('diplomes.index'); // Adjust this to your error page route
        }

        return view('diplomes.details',['diplome'=>$diplome]);
    }
    public function consulter(){
        $diplomes = diplomes::all();
        return view('diplomes.consulter',['diplomes'=>$diplomes]);
    }
}
