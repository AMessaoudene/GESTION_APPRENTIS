<?php

namespace App\Http\Controllers;
use App\Models\apprentis;
use App\Models\maitre_apprentis;
use Illuminate\Http\Request;
use App\Models\Supervisions;
use Validator;
use Illuminate\Support\Facades\Auth;

class SupervisionsController extends Controller
{
    public function index(){
        if(Auth::user()){
            $supervisions = Supervisions::all();
            $apprentis = apprentis::all();
            $maitres = maitre_apprentis::all();
            return view('supervisions.index', compact('supervisions', 'apprentis','maitres'));
        }
    }
    public function submit(Request $request){
        $rules = [
            'maitreapprenti_id' => 'required',
            'apprenti_id' => 'required',
            'datedebut' => 'required',
            'datefin' => 'required',
        ];

        $messages = [
            'maitreapprenti_id.required' => 'Le champ maitre apprenti est requis.',
            'apprenti_id.required' => 'Le champ apprenti est requis.',
            'datedebut.required' => 'Le champ date de debut est requis.',
            'datefin.required' => 'Le champ date de fin est requis.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Supervisions::where('apprenti_id',$request->apprenti_id)->update(
            ['datefin' => $request->datedebut , 'status' => 'inactif']
        );
        $supervision = new supervisions();
        $supervision->maitreapprenti_id = $request->maitreapprenti_id;
        $supervision->apprenti_id = $request->apprenti_id;
        $supervision->datedebut = $request->datedebut;
        $supervision->datefin = $request->datefin;
        $supervision->save();
    }
    public function destroy(Request $request,$id){
        $supervision = Supervisions::find($id);
        $supervision->delete();
    }
}
