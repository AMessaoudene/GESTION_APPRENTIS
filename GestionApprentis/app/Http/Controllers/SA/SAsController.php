<?php

namespace App\Http\Controllers\SA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SAsController extends Controller
{
    public function index()
    {
        // Check if the authenticated user has the role of DFP
        if (Auth::user()->Role === 'SA') {
            // User has the DFP role, allow access to the dashboard
            return view('SA.dashboard');
        } else {
            // Redirect or show an error page if the user doesn't have the DFP role
            return redirect()->back()->with('error', 'You do not have the required role to access this page.');
        }
    }
}
