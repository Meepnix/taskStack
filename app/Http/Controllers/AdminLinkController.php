<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\File;
use App\Location;

class AdminLinkController extends Controller
{
    public function create(Task $task)
    {
        $locations = Location::with('files')->get();
    }
}
