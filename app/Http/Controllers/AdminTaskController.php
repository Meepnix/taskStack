<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Group;

class AdminTaskController extends Controller
{
    /** 
     * Show task list
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $tasks = Task::all();
        

        return view('adminTasks.show', compact('tasks'));
    }

    public function create()
    {
        $groups = Group::all()->pluck('name', 'id');
        return view('adminTasks.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $task = new Task;
        
        $task->create($request->all());

        $task->groups()->attach($request->input('groups'));

        return redirect()->route('admin.task.show')->with('flash_message', 'Task Created');

    }

    

}
