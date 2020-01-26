<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Location;
use App\File;
use Gate;


class AdminFileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function create(Location $location)
    {

        return view('adminFiles.create', compact('location'));
    }

    public function destroy(File $file)
    {

        //Delete file storage
        Storage::delete($file->path);

        //Test deletion
        if (Storage::exists($file->path)){
            Log::error('PDF file ' .  $file->path . ' failed to delete');
        }

        $file->delete();

        return redirect()->route('admin.location.show')
                        ->with('flash_message', 'File deleted');
    }


    public function store(Request $request, Location $location)
    {
    
        $request->validate([

            'pdf' => 'required|mimetypes:application/pdf|mimes:pdf',

        ]);
        $file = $request->file('pdf');
        $path = $file->store('public/pdf');

        //Test file upload
        if (!Storage::exists($path) ) {
            Log::error('PDF file failed to upload');
            abort(500, 'File failed to upload');
        }

        $new = new File;
        $size = $file->getSize();

        //Set file size
        $new->size = ($size >= 1048576 ? round($size / 1048576) . ' MB':
                    ($size >= 1024 ? round($size / 1024) . ' KB': 
                    $new->size = $size . ' Bytes'));

        //Storage path
        $new->path = $path;

        //public path
        $new->public_path = substr($path, 6);

        $new->type = $file->getMimeType();
        $new->name = $file->getClientOriginalName();

        $location->files()->save($new);

        return redirect()->route('admin.location.show')
                        ->with('flash_message', 'Sucessfully Uploaded ' . $new->name);
    }
}
