<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Group;
use App\Label;

class AdminTaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    /** 
     * Show task list
     * 
     * @param  void
     * @return \Illuminate\Http\Response
    */
    public function show()
    {
        
        $tasks = Task::with('labels', 'files')->get();
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
        $request->validate([

            'title' => 'required',
            'message' => 'required',

        ]);
        
        $new = new Task;

        $task = $new->addTask($request);

        #Attach checked labels 
        $task->labels()->attach($request->label_check);

        #Attach linked files
        $links = collect($request->links)->pluck('id');
        $task->files()->attach($links);

        return response()->json(['redirect' => route('admin.task.show')], 200);
        
        
        #return redirect()->route('admin.task.show')->with('flash_message', 'Task ' . $task->title . ' Created');

    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.task.show')->with('flash_message', 'Task ' . $task->title . ' Deleted');

    }

    public function edit(Task $task)
    {
        $labels = Label::all();

        $label_chks = $task->labels;

        return view('adminTasks.edit', compact('task', 'labels', 'label_chks'));
    }

    public function update(Request $request, Task $task)
    {

        $request->validate([

            'title' => 'required',
            'message' => 'required',

        ]);

        #Update columns
        $task->title = $request->title;
        $task->message = $request->message;
    
        #Sync checked labels
        $task->labels()->sync($request->label_check);

        #Sync linked files
        $links = collect($request->links)->pluck('id');
        $task->files()->sync($links);
        
        $task->save();

        return response()->json(['redirect' => route('admin.task.show')], 200);
    }

    
    public function editLinks(Task $task)
    {
        return response()->json($task->files,200);
    }

    public function editTasks(Task $task)
    {

        $task->labels_chk = collect($task->labels)->pluck('id');
        
        return response()->json($task, 200);

    }
}
