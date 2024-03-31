<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\maitre_apprentis;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pv = Session::get('pv');
        $apprenti = Session::get('apprenti');
        $maitre_apprenti1 = maitre_apprentis::where('apprenti1_id', $apprenti->id)->first();
        $maitre_apprenti2 = maitre_apprentis::where('apprenti2_id', $apprenti->id)->first();
        ($maitre_apprenti1) ? $maitre_apprentis = $maitre_apprenti1 : $maitre_apprentis = $maitre_apprenti2;
        return view('pvinstallations.fiche',['pv' => $pv, 'apprenti' => $apprenti, 'maitre_apprentis' => $maitre_apprentis]);
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
        //
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
