<?php

namespace App\Http\Controllers;
use App\Models\decisionapprentis;
use App\Models\Avenants;
use Illuminate\Http\Request;

class DecisionsApprentisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $decision = decisionapprentis::all();

        return view('decisionsApprentis.index', compact('decision'));

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
        Avenants::where('decisionapprenti_id',$id)->update(['decisionapprenti_id' => null]);
        decisionapprentis::destroy($id);
        return redirect()->back();
    }
}
