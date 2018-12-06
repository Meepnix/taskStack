<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class AdminGroupController extends Controller
{
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
        $new = new Group;

        $new->create($request->all());
        return redirect()->route('admin.group.show')->with('flash_message', $request->name . ' Group Created');

    }

    public function destroy(Request $request, Group $group)
    {

        $group->delete();
        return redirect()->route('admin.group.show')->with('flash_message', $group->name . ' Group deleted');
    }


}
