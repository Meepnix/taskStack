<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Task;

class TaskController extends Controller
{
    public function index()
    {
        //Which group is user auth?
        //What time of day is it?

        //HTTP status OK

        //current day
        $weekMap = [
            0 => 'sun',
            1 => 'mon',
            2 => 'tue',
            3 => 'wed',
            4 => 'thu',
            5 => 'fri',
            6 => 'sat',
        ];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $weekDay = $weekMap[$dayOfTheWeek];

        $user = Auth::user();
        $group = $user->groups()->first();

        //return dd($user);

        return response()->json(Task::whereHas('slots', function ($query) use ($group, $weekDay) {
            $query->where([
                
                //Show tasks with slots of current group
                ['group_id', '=', $group->id],
                //Check slot is current day
                [$weekDay, '=', 1],
                
                ])

                ->orWhere([

                //Show tasks with slots of current group
                ['group_id', '=', $group->id],
                //Check slot is current day
                ['all', '=', 1],


                ]);

        })->with('labels', 'files')->get(), 200);

        //return response()->json(Task::with('labels', 'files')->get(),200);
    }


    public function show()
    {
        return view('Tasks.index');
    }

}
