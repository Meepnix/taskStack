<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\File;
use App\Location;

class AdminLinkController extends Controller
{
    public function create(Task $task)
    {
        $locations = Location::with('files')->get();

        //https://vue-multiselect.js.org

        //https://stackoverflow.com/questions/39792864/vue-multiselect-with-laravel-5-3

        //https://laravel.io/forum/07-21-2016-help-needed-with-vue-multiselect

        //https://medium.com/employbl/build-tagging-with-vue-multiselect-and-laravel-tags-960c260df438



    }
}
