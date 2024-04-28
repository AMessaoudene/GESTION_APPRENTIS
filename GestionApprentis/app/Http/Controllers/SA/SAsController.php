<?php

namespace App\Http\Controllers\SA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SAsController extends Controller
{
    public function index()
    {
        return view('SA.dashboard');
    }
}
