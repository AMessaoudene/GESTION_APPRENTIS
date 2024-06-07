<?php

namespace App\Http\Controllers;
use App\Models\baremes;
use App\Models\decisionapprentis;
use App\Models\refsalariares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefSalariairesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth::user()){
        $refsalariaires = refsalariares::all();
        return view('refsalariaires.index', compact('refsalariaires'));
        }
        else{
            return redirect()->route('login');
        }
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
        refsalariares::where('status','actif')->update(['status'=>'inactif']);
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
    public function destroy(Request $request,$id)
    {
        $baremes = baremes::where('refsalariaires_id',$id);
        $baremes->delete();
        refsalariares::destroy($id);
        return redirect()->back();
    }
}
