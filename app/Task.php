<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\Schedule;
use App\Label;

class Task extends Model
{
    protected $fillable = [
        'title',
        'message',
    ];

    /**
     * Retrieve Groups associated with the Task.
     *
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

      /**
     * Retrieve add new Task.
     *
     */
    public function addTask(Request $request)
    {
        return $this->create($request->all());
    }

    /**
     * Retrieve Schedules associated with the Task.
     *
     */
    public function schedules()
    {
        return $this->belongsToMany('App\Schedule')->withTimestamps();
    }

    /**
     * Retrieve Labels associated with the Task.
     * 
     */
    public function labels()
    {
        return $this->belongsToMany('App\Label')->withTimestamps();
    }

}
