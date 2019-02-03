<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Location;

class File extends Model
{
    
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

}
