<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Message;

class AdminMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

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

    public function update(Request $request, Message $message)
    {

        $message->update($request->all());

        return redirect()->route('admin.message.showGroups')->with('flash_message', 'Group Message Updated');

        
    }
}
