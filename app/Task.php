<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use App\Schedules;

class Task extends Model
{
    protected $fillable = [
        'title',
        'message',
    ];

    /**
     * Get the Groups associated with the Task.
     *
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }

    /**
     * Get the Schedules associated with the Task.
     *
     */
    public function schedules()
    {
        return $this->belongsToMany('App\Schedule')->withTimestamps();
    }

}
