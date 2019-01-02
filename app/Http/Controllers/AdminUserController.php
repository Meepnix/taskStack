<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;

class AdminUserController extends Controller
{
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route(admin.group.show)->with('flash_message', 'User ' . $user->name . ' Deleted');
    }

    public function store(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|max:191',
            'password' => 'required|max:191',
        ]);

        $new = new User;
        $new->name = $request->name;
        $new->password = bcrypt($request->password);
        $new->save();
        $group->users()->attach($new);

        return redirect()->route('admin.group.show')->with('flash_message', 'User ' . $new->name . ' Created');
    }

    public function create(Group $group)
    {
        return view('adminUsers.create', compact('group'));
    }

    public function edit(User $user)
    {
        $curGroups = Group::all()->pluck('name', 'id');
        $setGroups = $user->groups->pluck('id');

        return view('adminUsers.edit', compact('user', 'setGroups', 'curGroups'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->groups()->sync($request->input('groups'));

        return redirect()->route('admin.group.show')->with('flash_message', 'User ' . $user->name . ' Updated');
    }

}
