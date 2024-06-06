<?php

namespace App\Http\Controllers;
use App\Models\apprentis;
use App\Models\baremes;
use Illuminate\Http\Request;
use App\Models\Diplomes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiplomesController extends Controller
{
    public function index()
    {
        $diplomes = Diplomes::all();
        if(auth::user()){
            return view('diplomes.index', compact('diplomes'));
        }
        else{
            return redirect()->back()->with('error', 'You do not have the required role to access this page.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'duree' => 'required|integer',
            'description' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Diplomes::create($request->all());

        return redirect()->route('diplomes.index');
    }

    public function update(Request $request, $id)
    {
        $diplomes = Diplomes::findOrFail($id);
        $diplomes->nom = $request->nom;
        $diplomes->duree = $request->duree;
        $diplomes->description = $request->description;
        $diplomes->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        baremes::where('diplome_id',$id)->update(['diplome_id' => null]);
        apprentis::where('diplome1_id',$id)->update(['diplome1_id' => null]);
        apprentis::where('diplome2_id',$id)->update(['diplome2_id' => null]);
        Diplomes::destroy($id);
        return redirect()->back()->with('success');
    }
}