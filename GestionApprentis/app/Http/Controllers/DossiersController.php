<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use app\Models\dossiers;

class DossiersController extends Controller
{
    public function index(){
        return view("dossiers.consulter");
    }
    public function modify(Request $request){
        $rules = [
            'status' => 'required',
            'motif' => 'required|string|max:1000',
        ];
        $message = [
            'status.required' => 'The status field is required.',
            'motif.required' => 'The motif field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $dossiers = new dossiers();
            $dossiers->status = $request->input('status');
            $dossiers->motif = $request->input('motif');
            $dossiers->save();
            return redirect()->back()->with('success','');
        }
    }


}
