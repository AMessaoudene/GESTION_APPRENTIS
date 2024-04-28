<?php

namespace App\Http\Controllers\DRH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DRHController extends Controller
{
    public function index()
    {
        return view('DRH.dashboard');
    }
}
