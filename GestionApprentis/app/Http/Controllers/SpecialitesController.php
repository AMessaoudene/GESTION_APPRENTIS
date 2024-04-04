<?php

namespace App\Http\Controllers;
use App\Models\specialites;
use Illuminate\Http\Request;
use Validator;
class SpecialitesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialite = specialites::all();
        return view('specialites.index', compact('specialite'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nom' => 'required',
        ];

        $validate=Validator::make($request->all(), $rules);
        
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            $specialites = new specialites();
            $specialites->nom = $request->nom;
            $specialites->description = $request->description;
            $specialites->save();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
