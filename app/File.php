<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Location;

class File extends Model
{
    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['tasks'];


    protected $fillable = [
        'name',
        'path',
        'size',
        'type',
        'public_path',
    ];
    
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    function tasks()
    {
        return $this->belongsToMany('App\Task')->withTimestamps();
    }

}
