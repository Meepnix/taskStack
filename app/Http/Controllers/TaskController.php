<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Task;

use Illuminate\Support\Arr;

class TaskController extends Controller
{
    //current day
    public $weekMap = [
        0 => 'sun',
        1 => 'mon',
        2 => 'tue',
        3 => 'wed',
        4 => 'thu',
        5 => 'fri',
        6 => 'sat',
    ];

    public function index()
    {
    
        $time = Carbon::now();

        $weekDay = $this->weekMap[$time->dayOfWeek];

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
        elseif ($timeHm >= 1500 && $timeHm < 2350)
        {
            $timePeriod = "evening";
        }

        // Current User login
        $user = Auth::user();
        $group = $user->groups()->get()->pluck('id');

    
        return $this->taskQuery($group, $weekDay, $timePeriod, $user);
        

        
    }

    public function morning()
    {
        $time = Carbon::now();

        $weekDay = $this->weekMap[$time->dayOfWeek];

        $timePeriod = "morning";

        // Current User login
        $user = Auth::user();
        $group = $user->groups()->get()->pluck('id');


        return $this->taskQuery($group, $weekDay, $timePeriod, $user);

    }


    public function afternoon()
    {
        $time = Carbon::now();

        $weekDay = $this->weekMap[$time->dayOfWeek];

        $timePeriod = "afternoon";

        // Current User login
        $user = Auth::user();
        $group = $user->groups()->get()->pluck('id');


        return $this->taskQuery($group, $weekDay, $timePeriod, $user);

    }


    public function evening()
    {
        $time = Carbon::now();

        $weekDay = $this->weekMap[$time->dayOfWeek];

        $timePeriod = "evening";

        // Current User login
        $user = Auth::user();
        $group = $user->groups()->get()->pluck('id');


        return $this->taskQuery($group, $weekDay, $timePeriod, $user);

    }

    protected function taskQuery($group, $weekDay, $timePeriod, $user)
    {
        $tasks = Task::whereHas('slots', function ($query) use ($group, $weekDay, $timePeriod) {
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
        })->with('labels', 'files')->get();


        $tasks = Arr::add($tasks, 'period', $timePeriod);
        $tasks = Arr::add($tasks, 'username', $user->name);


        return response()->json($tasks, 200);
    }

    public function show()
    {
        return view('Tasks.index');
    }

}
