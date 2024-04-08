<?php

namespace App\Http\Controllers;
use App\Models\refsalariares;
use Illuminate\Http\Request;

class RefSalariairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $refsalariaires = refsalariares::all();
        return view('refsalariaires.index', compact('refsalariaires'));
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
        $refsalariares = new refsalariares();
        $refsalariares->version = $request->version;
        $refsalariares->snmg = $request->snmg;
        $refsalariares->salairereference = $request->salairereference;
        $refsalariares->save();
        return redirect('/refsalariaires');
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
