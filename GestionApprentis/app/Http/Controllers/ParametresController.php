<?php

namespace App\Http\Controllers;
use App\Models\parametres;
use Illuminate\Http\Request;
use Validator;

class ParametresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parametres = parametres::all();
        return view('parametres.index', compact('parametres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            
        ];
        $messages = [

        ];
        $validate=Validator::make($request->all(), $rules, $messages);
        if($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
            try{
                $parametres = new parametres();
                //$parametres->reference = $request->reference;

                $parametres->fill($request->all());
                $parametres->save();
                return redirect()->back();   
            }
            catch(\Exception $e){
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
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
