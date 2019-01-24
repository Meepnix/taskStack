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
        
        
        $mornings = $group->slots()->with('task')
            ->where('group_id', $group->id)
            ->where('time_period', 'morning')
            ->orderBy('id', 'desc')->get();

        $afternoons = $group->slots()->with('task')
            ->where('group_id', $group->id)
            ->where('time_period', 'afternoon')
            ->orderBy('id', 'desc')->get();

        $evenings = $group->slots()->with('task')
            ->where('group_id', $group->id)
            ->where('time_period', 'evening')
            ->orderBy('id', 'desc')->get();

        return view('adminSlots.show', compact('afternoons', 
                    'mornings', 'evenings', 'group'));

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

    public function destroyPartial(Slot $slot)
    {
        $slot->task_id = null;
        $slot->end_date = null;
        $slot->occurrence = null;
        $slot->mon = 0;
        $slot->tue = 0;
        $slot->wed = 0;
        $slot->thu = 0;
        $slot->fri = 0;
        $slot->all = 0;
        $slot->save();

        return redirect()->route('admin.slot.show')->with('flash_message', 'Slot emptied');
    }


}
