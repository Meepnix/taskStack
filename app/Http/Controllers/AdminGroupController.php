<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Slot;

class AdminGroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function show()
    {

        $groups = Group::all();
        
        return view('adminGroups.show', compact('groups'));
         
    }

    public function create()
    {
        return view('adminGroups.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|max:191',

        ]);


        $new = new Group;

        $group = $new->create($request->all());

        return redirect()->route('admin.group.show')->with('flash_message', $request->name . ' Group Created');


    }

    public function destroy(Request $request, Group $group)
    {

        $group->delete();
        return redirect()->route('admin.group.show')->with('flash_message', $group->name . ' Group deleted');
    }


}
