<?php

namespace App\Http\Controllers\SA;

use App\Http\Controllers\Controller;
use App\Models\apprentis;
use App\Models\maitre_apprentis;
use App\Models\structures;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SAsController extends Controller
{
    public function index()
    {
        $apprentis = apprentis::where('structure_id',Auth::user()->structures_id);
        $totalapprentis = apprentis::where('structure_id',Auth::user()->structures_id)->count();
        $maitres = maitre_apprentis::where('affectation',Auth::user()->structures_id);
        $totalmaitres = maitre_apprentis::where('affectation',Auth::user()->structures_id)->count();
        $structures = structures::all();
        $totalstructures = structures::count();
        // Query to fetch all datecontrat from apprenti table
        $contracts = apprentis::where('structure_id',Auth::user()->structures_id)->select('datecontrat')->get();

        // Initialize an array to hold counts for each month
        $monthlyCounts = array_fill(0, 12, 0);

        // Process each contract to count the number of contracts per month
        foreach ($contracts as $contract) {
            $month = (int)date('m', strtotime($contract->datecontrat)) - 1;
            $monthlyCounts[$month]++;
        }
        // Check if the authenticated user has the role of SA
        if (Auth::user()->role === 'SA') {
            // User has the SA role, allow access to the dashboard
            return view('SA.dashboard',compact('apprentis','maitres','totalstructures','totalmaitres','structures','totalapprentis','monthlyCounts'));
        } else {
            // Redirect or show an error page if the user doesn't have the SA role
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }
    }
}
