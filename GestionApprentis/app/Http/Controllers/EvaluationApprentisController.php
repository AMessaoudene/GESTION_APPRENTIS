<?php

namespace App\Http\Controllers;
use App\Models\evaluation_apprentis;
use App\Models\apprentis;
use Illuminate\Http\Request;
use Validator;
class EvaluationApprentisController extends Controller
{
    public function index()
    {
        $apprentis = apprentis::all(); // Retrieve all evaluations, adjust this based on your actual model
        return view('evaluation_apprentis.ajouter', compact('apprentis'));
    }
    public function submit(Request $request){
        $rules = [
            'reference' => 'required|unique|string|max:255',
            'datedebut' => 'required|date',
            'datefin ' => 'required|date',
            'comportementsociabilite ' => 'required|string|max:255',
            'observationcs ' => 'required|string|max:255',
            'communication ' => 'required|string|max:255',
            'observationc ' => 'required|string|max:255',
            'organisationhygiene ' => 'required|string|max:255',
            'observationoh ' => 'required|string|max:255',
            'ponctualiteassiduite ' => 'required|string|max:255',
            'observationpa' => 'required|string|max:255',
            'respectreglementinterieur' => 'required|string|max:255',
            'observationrri' => 'required|string|max:255',
            'discipline' => 'required|string|max:255',
            'observationd' => 'required|string|max:255',
            'interettravail' => 'required|string|max:255',
            'observationit' => 'required|string|max:255',
            'motivation' => 'required|string|max:255',
            'observationm' => 'required|string|max:255',
            'espritinitiative' => 'required|string|max:255',
            'observationei' => 'required|string|max:255',
            'evolutionprocessusintegration' => 'required|string|max:255',
            'observationepi' => 'required|string|max:255',
            'qualificationsprofessionelles' => 'required|string|max:255',
            'observationqp' => 'required|string|max:255',
            'sensresponsabilite' => 'required|string|max:255',
            'observationsr' => 'required|string|max:255',
        ];
        $messages = [
            'reference.required' => 'Le champ :attribute est obligatoire.',
            'reference.unique' => 'Le champ :attribute doit être unique.',
            'datedebut.required' => 'Le champ :attribute est obligatoire.',
            'datedebut.date' => 'Le champ :attribute doit être une date.',
            'datefin.required' => 'Le champ :attribute est obligatoire.',
            'datefin.date' => 'Le champ :attribute doit être une date.',
            'comportementsociabilite.required' => 'Le champ :attribute est obligatoire.',
            'observationcs.required' => 'Le champ :attribute est obligatoire.',
            'communication.required' => 'Le champ :attribute est obligatoire.',
            'observationc.required' => 'Le champ :attribute est obligatoire.',
            'organisationhygiene.required' => 'Le champ :attribute est obligatoire.',
            'observationoh.required' => 'Le champ :attribute est obligatoire.',
            'ponctualiteassiduite.required' => 'Le champ :attribute est obligatoire.',
            'observationpa.required' => 'Le champ :attribute est obligatoire.',
            'respectreglementinterieur.required' => 'Le champ :attribute est obligatoire.',
            'observationrri.required' => 'Le champ :attribute est obligatoire.',
            'discipline.required' => 'Le champ :attribute est obligatoire.',
            'observationd.required' => 'Le champ :attribute est obligatoire.',
            'interettravail.required' => 'Le champ :attribute est obligatoire.',
            'observationit.required' => 'Le champ :attribute est obligatoire.',
            'motivation.required' => 'Le champ :attribute est obligatoire.',
            'observationm.required' => 'Le champ :attribute est obligatoire.',
            'espritinitiative.required' => 'Le champ :attribute est obligatoire.',
            'observationei.required' => 'Le champ :attribute est obligatoire.',
            'evolutionprocessusintegration.required' => 'Le champ :attribute est obligatoire.',
            'observationepi.required' => 'Le champ :attribute est obligatoire.',
            'qualificationsprofessionelles.required' => 'Le champ :attribute est obligatoire.',
            'observationqp.required' => 'Le champ :attribute est obligatoire.',
            'sensresponsabilite.required' => 'Le champ :attribute est obligatoire.',
            'observationsr.required' => 'Le champ :attribute est obligatoire.',

        ];
        $validator = Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $evaluation = new evaluation_apprentis();
            $evaluation->reference = request('reference');
            $evaluation->datedebut = request('datedebut');
            $evaluation->datefin = request('datefin');
            $evaluation->comportementsociabilite = request('comportementsociabilite');
            $evaluation->observationcs = request('observationcs');
            $evaluation->communication = request('communication');
            $evaluation->observationc = request('observationc');
            $evaluation->organisationhygiene = request('organisationhygiene');
            $evaluation->observationoh = request('observationoh');
            $evaluation->ponctualiteassiduite = request('ponctualiteassiduite');
            $evaluation->observationpa = request('observationpa');
            $evaluation->respectreglementinterieur = request('respectreglementinterieur');
            $evaluation->observationrri = request('observationrri');
            $evaluation->discipline = request('discipline');
            $evaluation->observationd = request('observationd');
            $evaluation->interettravail = request('interettravail');
            $evaluation->observationit = request('observationit');
            $evaluation->qualification = request('qualification');
            $evaluation->observationq = request('observationq');
            $evaluation->motivation = request('motivation');
            $evaluation->observationm = request('observationm');
            $evaluation->espritinitiative = request('espritinitiative');
            $evaluation->observationei = request('observationei');
            $evaluation->evolutionprocessusintegration = request('evolutionprocessusintegration');
            $evaluation->observationepi = request('observationepi');
            $evaluation->qualificationsprofessionelles = request('qualificationsprofessionelles');
            $evaluation->observationqp = request('observationqp');
            $evaluation->sensresponsabilite = request('sensresponsabilite');
            $evaluation->observationsr = request('observationsr');
            $evaluation->save();
            return redirect()->back()->with('success', 'Evaluation ajoutée avec succès');
        }
    }
}
