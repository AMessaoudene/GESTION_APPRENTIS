<?php

namespace App\Http\Controllers;
use App\Models\parametres;
use Illuminate\Http\Request;
use App\Models\baremes;
use Session;
class DecisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parametres = parametres::all();
        $baremes = baremes::all();
        $pv = Session::get('pv');
        return view('decisions.index', compact('parametres','baremes','pv'));
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
