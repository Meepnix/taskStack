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

        $cheese = $group->load('slots.task');

        dd($cheese->slots->first()->task);

        $test = Group::all();

        dd($test->load('slots.task'));

        


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

        return redirect()->route('admin.slot.show', [$group->id])->with('flash_message', 'Slot created');
    }

    public function edit(Slot $slot)
    {

        $curTask = Task::all()->pluck('title', 'id');

        return view('adminSlots.edit', compact('curTask', 'slot'));
    }

    public function update(Request $request, Slot $slot)
    {
        $slot->update($request->all());

        return redirect()->route('admin.slot.show', [$slot->group_id])->with('flash_message', 'Slot updated');

    }

    public function deletePartial(Slot $slot)
    {
        $slot->task_id = '';
        $slot->end_date = '';
        $slot->ocurrence = '';
        $slot->mon = 0;
        $slot->tue = 0;
        $slot->wed = 0;
        $slot->thu = 0;
        $slot->fri = 0;
        $slot->all = 0;
        $slot->save();

        return redirect()->route('admin.slot.show', 'Slot emptied');
    }


}
