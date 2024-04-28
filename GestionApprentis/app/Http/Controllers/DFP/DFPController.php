<?php

namespace App\Http\Controllers\DFP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DFPController extends Controller
{
    public function index()
    {
        return view('DFP.dashboard');
    }
}
