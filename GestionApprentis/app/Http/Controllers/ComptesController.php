<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use App\Models\structures;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
class ComptesController extends Controller
{
    public function index(){
        if(auth::user()){
            $comptes = user::all();
            $structures = structures::all();
            return view('comptes.index',compact('comptes','structures'));
        }
        else{
            return redirect()->route('login');
        }
    }
    
        public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'civilite' => ['required'],
            'email' => ['required'],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required'],
            'structures_id' => ['required'],
        ]);
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
