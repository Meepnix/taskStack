<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slot;
use App\Group;

class AdminSlotController extends Controller
{
    public function showMorning(Group $group)
    {
        $slots = $group->slots->where('time_period', 'morning')->orderBy('slot', 'asc');

        return view('adminSlots.show', compact('slots'));

    }

}
