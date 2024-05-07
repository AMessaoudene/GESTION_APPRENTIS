<?php

namespace App\Http\Controllers;

use App\Models\apprentis;
use Illuminate\Http\Request;
use App\Models\departs;
use Auth;

class DepartsController extends Controller
{
    public function index()
    {
        $user = auth::user();
        $departs = departs::all();
        $apprentis = apprentis::all();
        return view('departs.index', compact('departs','apprentis','user'));
    }
}
