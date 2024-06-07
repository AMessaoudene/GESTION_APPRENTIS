<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use App\Models\structures;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class ComptesController extends Controller
{
    public function index(){
        if(auth::user()->status == 'active'){
            $comptes = user::all();
            $structures = structures::all();
            return view('comptes.index',compact('comptes','structures'));
        }
        else{
            return redirect()->route('login');
        }
    }
    
        public function store(Request $request){
        // Validation rules
        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'civilite' => 'required|string|max:255',
            'email' => 'required|unique:users|email|max:255',
            'structures_id' => 'required',
            'password' => 'required|string|min:8',
        ];

        // Custom error messages
        $messages = [
            'email.unique' => 'The email already exists.',
            'password.min' => 'The password must be at least 8 characters.',
            'nom.required' => 'nom est requis',
            'prenom.required' => 'prenom est requis',
            'civilite.required' => 'civilite est requise',
            'email.required' => 'email est requis',
            'structures_id.required' => 'structure est requise',
            'password.required' => 'password est requis',
        ];

        // Validate the incoming request
        $validator = Validator::make($request->all(), $rules, $messages);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        User::where('structures_id', $request->structures_id)->where('role', $request->role)->where('status', 'active')->update(['status' => 'inactive']);
        $compte = new user();
        $compte->nom = $request->nom;
        $compte->prenom = $request->prenom;
        $compte->civilite = $request->civilite;
        $compte->email = $request->email;
        $compte->password = Hash::make($request->password);
        $compte->role = $request->role;
        $compte->structures_id = $request->structures_id;
        $compte->status = "active";
        $compte->save();
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $compte = user::findOrFail($id);
        $compte->nom = $request->nom;
        $compte->prenom = $request->prenom;
        $compte->civilite = $request->civilite;
        $compte->email = $request->email;
        $compte->password = Hash::make($request->password);
        $compte->role = $request->role;
        $compte->structures_id = $request->structures_id;
        $compte->status = $request->status;
        $compte->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        user::destroy($id);
        return redirect()->back()->with('success');
    }
}
