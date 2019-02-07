<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\File;

class AdminFileController extends Controller
{
    public function create(Location $location)
    {
        return view('adminFiles.create', compact('location'));
    }


    public function store(Request $request, Location $location)
    {
        $request->validate([

            'pdf' => 'required|mimetypes:application/pdf|mimes:pdf'

        ]);
        $file = $request->file('pdf');
        $path = $file->store('pdf');

        $new = new File;
        $size = $file->getSize();

        if ($size >= 1048576)
        {
            //MegaByte worth of bytes
            $new->size = $size / 1048576 . ' MB'; 
        }
        elseif ($size >= 1024)
        {
            //KiloByte worth of bytes
            $new->size = $size / 1024 . ' KB';
        }
        else
        {
            //Bytes worth of data
            $new->size = $size . ' Bytes';
        }

        $new->path = $path;
        $new->type = $file->getMimeType();
        $new->name = $file->getClientOriginalName();

        $location->files()->save($new);

        return redirect()->route('admin.location.show')->with('flash_message', 'Sucessfully Uploaded ' . $new->name);
    }
}
