<?php
namespace App\Http\Controllers;
use App\Models\structures;
use App\Models\utilisateurs;
use Illuminate\Http\Request;
use Validator;

class UtilisateursController extends Controller
{
    public function index()
    {
        $structures = structures::all();
        return view('utilisateurs.ajouter', compact('structures'));
    }

    public function submit(Request $request)
    {

        // Define validation rules based on the source
        $rules =[
            'structure_id' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                // Create a new user
                $utilisateur = new utilisateurs();
                $utilisateur->structure_id = $request->structure_id;
                $utilisateur->role = $request->role;
                $utilisateur->email = $request->email;
                $utilisateur->password = bcrypt($request->password);
                $utilisateur->save();
                
                return redirect()->back()->with('success', 'Utilisateur ajouté avec succès');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'utilisateur');
            }
        }
    }

    public function insertion(Request $request){
        $utilisateurs = utilisateurs::all();
        return view('utilisateurs.completion', compact('utilisateurs'));
    }
    public function completion(Request $request){
        $rules = [
            'nomresponsable' => 'required',
            'prenomresponsable' => 'required',
            'civiliteresponsable'=>'required',
            'numerofixe' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                // Create a new user
                $utilisateur = utilisateurs::find($request->id);
                $utilisateur->nomresponsable = $request->nomresponsable;
                $utilisateur->prenomresponsable = $request->prenomresponsable;
                $utilisateur->civiliteresponsable = $request->civiliteresponsable;
                $utilisateur->numerofixe = $request->numerofixe;
                $utilisateur->save();
                
                return redirect()->back()->with('success', 'Utilisateur modifié avec succès');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la modification de l\'utilisateur');
            }
        }
    }
}
