<?php

namespace App\Http\Controllers\EvaluateurGrade;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluateurGradeController extends Controller
{
    public function index()
    {
        return view('evaluateurgrade.dashboard');
    }
}
