<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Supervisions;

class SupervisionsController extends Controller
{
    public function index(){
        return view('Supervisions.index');
    }
    public function destroy(Request $request,$id){
        $supervision = Supervisions::find($id);
        $supervision->delete();
    }
}
