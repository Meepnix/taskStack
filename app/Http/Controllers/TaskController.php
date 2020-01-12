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

        $time = Carbon::now();

        $weekDay = $weekMap[$time->dayOfWeek];

        $timeHm = $time->hour . ($time->minute < 10 ? 0 . $time->minute : $time->minute);

        // Morning 8:00am till 12:00pm
        if ($timeHm >= 00 && $timeHm < 1200)
        {
            $timePeriod = "morning";

        } // Afternoon (Early Afternoon) 12:00pm till 3:00pm
        elseif ($timeHm >= 1200 && $timeHm < 1500)
        {
            $timePeriod = "afternoon";

        } // Evening (Late Afternoon) 3:00pm till 7:00pm
        elseif ($timeHm >= 1500 && $timeHm < 1900)
        {
            $timePeriod = "evening";
        }

        // Current User login
        $user = Auth::user();
        $group = $user->groups()->get()->pluck('id');

        

       
        return response()->json(Task::whereHas('slots', function ($query) use ($group, $weekDay, $timePeriod) {
            $query->whereIn('group_id', $group)
            
            
                ->where([
                
                
                //Check slot is current day
                [$weekDay, '=', 1],
                //Check day period
                ['time_period', '=', $timePeriod],
                
                ])

                ->orWhere([

                //Show tasks with slots of current group
                //['group_id', '=', $group->id],
                //Check slot is current day
                ['all', '=', 1],
                //Check day period
                ['time_period', '=', $timePeriod],


                ]);

        //HTTP status OK
        })->with('labels', 'files')->get(), 200);

        
    }


    public function show()
    {
        return view('Tasks.index');
    }

}
