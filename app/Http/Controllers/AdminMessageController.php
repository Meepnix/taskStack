<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Message;

class AdminMessageController extends Controller
{
    public function showGroups()
    {

        $groups = Group::all();

        return view('adminMessages.showGroups', compact('groups'));

    }

    public function edit(Group $group)
    {
        $message = Message::firstOrCreate(['group_id' => $group->id]);

        return view('adminMessages.edit', compact('message'));
    }

    public function update()
    {

    }
}
