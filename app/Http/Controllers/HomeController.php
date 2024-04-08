<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    function __construct() {
        $this ->middleware('auth');
    }

    //return view from here 
    public function dashboard()
    {
        return view('dashboard');
    }
}
