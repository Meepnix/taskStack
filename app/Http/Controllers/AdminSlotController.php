<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slot;
use App\Group;
use App\Task;

class AdminSlotController extends Controller
{
    public function show(Group $group)
    {
        $mornings = $group->slots->where('time_period', 'morning')->sortBy('id');
        $afternoons = $group->slots->where('time_period', 'afternoon')->sortBy('id');
        $evenings = $group->slots->where('time_period', 'evening')->sortBy('id');


        return view('adminSlots.show', compact('mornings', 'afternoons', 'evenings', 'group'));

    }

    public function showGroups()
    {
        $groups = Group::all();

        return view('adminSlots.showGroups', compact('groups'));
    }

    public function create(Group $group)
    {
        $curTask = Task::all()->pluck('title', 'id');
        
        return view('adminSlots.create', compact('curTask', 'group'));

    }

    public function store(Request $request, Group $group)
    {
        $group->slots()->create($request->all());

        return redirect()->route('admin.slots.show');
    }


}
