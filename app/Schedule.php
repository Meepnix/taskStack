<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Schedule extends Model
{
    /**
     * Get the Tasks associated with the schedule.
     *
     */
    function tasks()
    {
        return $this->belongsToMany('App\Task')->withTimestamps();
    }

    
}
