<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('dashboard');
    }
    

}
