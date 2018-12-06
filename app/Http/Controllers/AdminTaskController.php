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
     * @param  void
     * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $tasks = Task::all();
        return view('adminTasks.show', compact('tasks'));
    }

    /** 
     * Show task create page
     * 
     * @param  void
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $groups = Group::all()->pluck('name', 'id');
        return view('adminTasks.create', compact('groups'));
    }

     /** 
     * Store new task
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $new = new Task;
        
        $task = $new->addTask($request);
        return redirect()->route('admin.task.show')->with('flash_message', 'Task Created');

    }

    

}
