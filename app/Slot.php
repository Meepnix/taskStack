<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\Task;

class Slot extends Model
{

    protected $fillable = [
        'time_period',
        'mon',
        'tue',
        'wed',
        'thu',
        'fri',
        'sat',
        'sun',
        'all',
    ];

    /**
     * Get the Group associated with the slot.
     *
     */

    function group()
    {
        return $this->belongsTo('App\Group');
    }

    /**
     * Get the task associated with the slot.
     *
     */

    function task()
    {
        return $this->belongsTo('App\Task');
    }
}
