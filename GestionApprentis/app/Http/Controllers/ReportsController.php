<?php

namespace App\Http\Controllers;
use App\Models\reports;
use App\Models\structures;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(){
        if(Auth::user()->status == 'active'){
            $structures = structures::all();
            $users = user::all();
            $reports = reports::all();
            return view('reports.index',compact('structures','users','reports'));
        }
        else{
            return redirect()->back()->with('error');
        }
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'titre' => 'required',
        ]);
        $report = new reports();
        $report->user_id = $request->user_id;
        $report->titre = $request->titre;
        $report->description = $request->description;
        $report->save();
        return redirect()->back()->with('success');
    }

    public function destroy($id){
        $report = reports::findOrFail($id);
        $report->delete();
        return redirect()->back()->with('success');
    }
}
