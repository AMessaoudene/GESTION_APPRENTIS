<?php

namespace App\Http\Controllers\DFP;

use App\Http\Controllers\Controller;
use App\Models\maitre_apprentis;
use App\Models\structures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\apprentis;

class DFPController extends Controller
{
    public function index()
    {
        $apprentis = apprentis::all();
        $totalapprentis = apprentis::count();
        $maitres = maitre_apprentis::all();
        $totalmaitres = maitre_apprentis::count();
        $structures = structures::all();
        $totalstructures = structures::count();
        // Query to fetch all datecontrat from apprenti table
        $contracts = DB::table('apprentis')->select('datecontrat')->get();

        // Initialize an array to hold counts for each month
        $monthlyCounts = array_fill(0, 12, 0);

        // Process each contract to count the number of contracts per month
        foreach ($contracts as $contract) {
            $month = (int)date('m', strtotime($contract->datecontrat)) - 1;
            $monthlyCounts[$month]++;
        }
        // Check if the authenticated user has the role of DFP
        if (Auth::user()->role === 'DFP') {
            // User has the DFP role, allow access to the dashboard
            return view('DFP.dashboard',compact('apprentis','maitres','totalstructures','totalmaitres','structures','totalapprentis','monthlyCounts'));
        } else {
            // Redirect or show an error page if the user doesn't have the DFP role
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }
    }
}
