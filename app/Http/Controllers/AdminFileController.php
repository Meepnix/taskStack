<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class AdminFileController extends Controller
{
    public function create(Location $location)
    {
        return view('adminFiles.create', compact('location'));
    }


    public function store(Request $request, Location $location)
    {
        $path = $request->file('pdf');
        $path->store('pdf');
        dd($path->getSize());

        $file->getMimeType();

        $file->getClientOriginalName();
    }
}
