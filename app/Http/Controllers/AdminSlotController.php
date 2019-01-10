<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slot;
use App\Group;

class AdminSlotController extends Controller
{
    public function show(Group $group)
    {
        $mornings = $group->slots->where('time_period', 'morning')->sortBy('id');
        $afternoons = $group->slots->where('time_period', 'afternoon')->sortBy('id');
        $evenings = $group->slots->where('time_period', 'evening')->sortBy('id');


        return view('adminSlots.show', compact('mornings', 'afternoons', 'evenings'));

    }

    public function showGroups()
    {
        $groups = Group::all();

        return view('adminSlots.showGroups', compact('groups'));
    }

    public function createMorning()
    {

    }

    public function store(Request $request, Group $group)
    {
        $group->slots()->create($request->all());

        return redirect()->route('adminSlots.show');
    }


}
