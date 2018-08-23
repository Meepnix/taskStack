<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Group extends Model
{

    /**
     * Get the Users associated with the Group.
     *
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
