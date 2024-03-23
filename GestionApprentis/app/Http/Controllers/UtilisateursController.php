<?php

namespace App\Http\Controllers;
use App\Models\utilisateurs;
use Illuminate\Http\Request;
use Validator;
class UtilisateursController extends Controller
{
    public function index()
    {
        return view('utilisateurs.ajouter');
    }
    public function submit(Request $request)
    {
        $rules = [
            'nom' => 'required',
            'structure' => 'required',
            'type' => 'required',
            'numerofixe' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'acces' => 'required',
        ];
        $messages = [
            'nom.required' => "Le nom est obligatoire",
            'structure.required' => "La structure est obligatoire",
            'type.required' => "Le type est obligatoire",
            'numerofixe.required' => "Le numéro fixe est obligatoire",
            'email.required' => "L'email est obligatoire",
            'password.required' => "Le mot de passe est obligatoire",
            'confirm_password.required' => "La confirmation du mot de passe est obligatoire",
            'acces.required' => "L'accès est obligatoire",
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            try{
                // Enregistrement des informations de l'utilisateur dans la base de données
                $utilisateurs = new utilisateurs();
                $utilisateurs->fill($request->all());
                $utilisateurs->save();
                return redirect()->back()->with('success', 'Utilisateur ajouté avec succès');
            }
            catch(\Exception $e){
                return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout de l\'utilisateur');
            }
        }
    }
}
