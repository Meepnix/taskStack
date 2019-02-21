<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Location;

class Image extends Model
{
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
}
