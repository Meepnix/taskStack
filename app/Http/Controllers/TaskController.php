<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        //HTTP status OK
        return response()->json(Task::with('labels', 'files')->get(),200);
    }

}
