<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Label extends Model
{
    protected $fillable = [
        'name',
        'html',
    ];

    /**
     * Get the Tasks associated with the label.
     *
     */
    function tasks()
    {
        return $this->belongsToMany('App\Task')->withTimestamps();
    }
}
