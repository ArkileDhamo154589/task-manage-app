<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //return view from here 
    public function dashboard()
    {
        return view('dashboard');
    }
}
