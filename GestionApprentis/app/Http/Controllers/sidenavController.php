<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
class sidenavController extends Controller
{

    public function index(){
        $user = Auth::user();
        return view('layouts.sidenav',compact('user'));
    }
}
