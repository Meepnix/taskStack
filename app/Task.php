<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class Task extends Model
{
    /**
     * Get the Group associated with the Task.
     *
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group')->withTimestamps();
    }
}
