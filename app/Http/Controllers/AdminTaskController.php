<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Group;
use App\Label;

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
        
        $tasks = Task::with('labels')->get();
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
        $labels = Label::all();

        return view('adminTasks.create', compact('labels'));
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

        #Attach checked labels
        $task->labels()->attach($request->label_check);
        

        return redirect()->route('admin.task.show')->with('flash_message', 'Task ' . $task->title . ' Created');

    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.task.show')->with('flash_message', 'Task ' . $task->title . ' Deleted');

    }

    public function edit(Request $request, Task $task)
    {
        $labels = Label::all();

        $label_chks = $task->labels;

        return view('adminTasks.edit', compact('task', 'labels', 'label_chks'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        $task->labels()->sync($request->label_check);

        return redirect()->route('admin.task.show')->with('flash_message', 'Task' . $task->title. ' Updated');
    }

    

}
