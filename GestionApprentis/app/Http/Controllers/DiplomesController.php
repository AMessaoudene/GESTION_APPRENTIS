<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Diplomes;
use Illuminate\Support\Facades\Validator;

class DiplomesController extends Controller
{
    public function index()
    {
        $diplomes = Diplomes::all();
        return view('diplomes.index', compact('diplomes'));
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
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Diplomes::destroy($id);
        return redirect()->back();
    }
}