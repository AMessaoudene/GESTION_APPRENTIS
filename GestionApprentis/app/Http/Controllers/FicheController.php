<?php

namespace App\Http\Controllers;
use App\Models\pv_installations;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\maitre_apprentis;
use App\Models\diplomes;
use App\Models\structures;
use App\Models\apprentis;
use App\Models\parametres;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function pv(Request $request,$apprenti_id)
    {
        $pv = pv_installations::where('apprenti_id',$apprenti_id);
        return view('pvinstallations.fiche',compact('pv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function decisionA()
    {
        $pv = Session::get('pv');
        $parametres = parametres::all();
        return view('decisions.ficheA', compact('pv', 'parametres'));
    }

    public function decisionMA(string $id)
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
