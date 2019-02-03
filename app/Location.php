<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;


class Location extends Model
{
    protected $fillable = [
        'name', 'depth',
    ];


public function files()
{

    return $this->hasMany('App\File');
}


}
