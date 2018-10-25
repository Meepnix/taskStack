<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class AdminGroupController extends Controller
{
    function show()
    {
        $groups = Group::all();


        return view('adminGroups.show', compact('groups'));
         
    }
}
