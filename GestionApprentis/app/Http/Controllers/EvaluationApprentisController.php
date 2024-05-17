<?php

namespace App\Http\Controllers;

use App\Models\evaluation_apprentis;
use App\Models\apprentis;
use App\Models\structures;
use App\Models\supervisions;
use Illuminate\Http\Request;
use App\Models\maitre_apprentis;
use Validator;

class EvaluationApprentisController extends Controller
{
    public function index()
    {
        $apprentis = apprentis::all();
        $structures = structures::all();
        $evaluations = evaluation_apprentis::all();
        $maitreapprentis = maitre_apprentis::all();
        $supervisions = supervisions::all();
        return view('evaluation_apprentis.index', compact('apprentis', 'structures', 'evaluations', 'maitreapprentis', 'supervisions'));
    }

    public function submit(Request $request)
    {
        $rules = [
            'reference' => 'required|unique:evaluation_apprentis,reference|string|max:255',
            'datedebut' => 'required|date',
            'datefin' => 'required|date',
            'comportementsociabilite' => 'required|string|max:255',
            'communication' => 'required|string|max:255',
            'organisationhygiene' => 'required|string|max:255',
            'ponctualiteassiduite' => 'required|string|max:255',
            'respectreglementinterieur' => 'required|string|max:255',
            'discipline' => 'required|string|max:255',
            'interettravail' => 'required|string|max:255',
            'motivation' => 'required|string|max:255',
            'espritinitiative' => 'required|string|max:255',
            'evolutionprocessusintegration' => 'required|string|max:255',
            'qualificationsprofessionelles' => 'required|string|max:255',
            'sensresponsabilite' => 'required|string|max:255',
        ];

        $messages = [
            'reference.required' => 'Le champ référence est obligatoire.',
            'reference.unique' => 'Cette référence est déjà utilisée.',
            'datedebut.required' => 'Le champ date début est obligatoire.',
            'datedebut.date' => 'Le champ date début doit être une date.',
            'datefin.required' => 'Le champ date fin est obligatoire.',
            'datefin.date' => 'Le champ date fin doit être une date.',
            'comportementsociabilite.required' => 'Le champ comportement sociabilité est obligatoire.',
            'communication.required' => 'Le champ communication est obligatoire.',
            'organisationhygiene.required' => 'Le champ organisation hygiène est obligatoire.',
            'ponctualiteassiduite.required' => 'Le champ ponctualité et assiduité est obligatoire.',
            'respectreglementinterieur.required' => 'Le champ respect règlement intérieur est obligatoire.',
            'discipline.required' => 'Le champ discipline est obligatoire.',
            'interettravail.required' => 'Le champ intérêt de travail est obligatoire.',
            'motivation.required' => 'Le champ motivation est obligatoire.',
            'espritinitiative.required' => 'Le champ esprit initiative est obligatoire.',
            'evolutionprocessusintegration.required' => 'Le champ évolution processus intégration est obligatoire.',
            'qualificationsprofessionelles.required' => 'Le champ qualifications professionnelles est obligatoire.',
            'sensresponsabilite.required' => 'Le champ sens responsabilité est obligatoire.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $evaluation = new evaluation_apprentis();
            $evaluation->reference = $request->reference;
            $evaluation->apprenti_id = $request->apprenti_id;
            $evaluation->datedebut = $request->datedebut;
            $evaluation->datefin = $request->datefin;
            $evaluation->comportementsociabilite = $request->comportementsociabilite;
            $evaluation->observationcs = $request->observationcs;
            $evaluation->communication = $request->communication;
            $evaluation->observationc = $request->observationc;
            $evaluation->organisationhygiene = $request->organisationhygiene;
            $evaluation->observationoh = $request->observationoh;
            $evaluation->ponctualiteassiduite = $request->ponctualiteassiduite;
            $evaluation->observationpa = $request->observationpa;
            $evaluation->respectreglementinterieur = $request->respectreglementinterieur;
            $evaluation->observationrri = $request->observationrri;
            $evaluation->discipline = $request->discipline;
            $evaluation->observationd = $request->observationd;
            $evaluation->interettravail = $request->interettravail;
            $evaluation->observationit = $request->observationit;
            $evaluation->motivation = $request->motivation;
            $evaluation->observationm = $request->observationm;
            $evaluation->espritinitiative = $request->espritinitiative;
            $evaluation->observationei = $request->observationei;
            $evaluation->evolutionprocessusintegration = $request->evolutionprocessusintegration;
            $evaluation->observationepi = $request->observationepi;
            $evaluation->qualificationsprofessionelles = $request->qualificationsprofessionelles;
            $evaluation->observationqp = $request->observationqp;
            $evaluation->sensresponsabilite = $request->sensresponsabilite;
            $evaluation->observationsr = $request->observationsr;
            $evaluation->save();
            return redirect()->back()->with('success', 'Évaluation ajoutée avec succès');
        }
    }
}
