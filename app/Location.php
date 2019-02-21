<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\File;
use App\Image;


class Location extends Model
{
    protected $fillable = [
        'name', 'depth',
    ];


    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function images()
    {

        return $this->hasMany('App\Image');

    }

}
