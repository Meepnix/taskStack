<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\File;
use App\Location;

class AdminLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }


    public function create(Task $task)
    {
        $locations = Location::with('files')->get();


    }
}
