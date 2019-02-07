<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Location;

class File extends Model
{
    protected $fillable = [
        'name',
        'path',
        'size',
        'type',
    ];
    
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

}
