<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class Message extends Model
{
    protected $fillable = [
        'message', 'enabled', 'group_id',
    ];

    /**
     * Get the Group associated with the Message.
     */
    public function group()
    {
        return $this->belongsTo('App\Group');

    }
}
