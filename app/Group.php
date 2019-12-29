<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Slot;
use App\Message;

class Group extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the Users associated with the Group.
     *
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * Get the Slots associated with the Group.
     */
    public function slots()
    {
        return $this->hasMany('App\Slot');
    }

    /**
     * Get the Messages associated with the Group.
     */
    public function message()
    {
        return $this->hasOne('App\Message');
    }
}
