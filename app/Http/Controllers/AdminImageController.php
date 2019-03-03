<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Location;
use App\Image;

class AdminImageController extends Controller
{
    public function create(Location $location) 
    {

        return view('adminImages.create', compact('location'));

    }

    public function destroy(Image $image)
    {
        //Delete image storage
        Storage::delete($image->path);

        //Test deletion
        if (Storage::exists($image->path)){
            Log::error('Image file ' .  $image->path . ' failed to delete');
        }

        $image->delete();

        return redirect()->route('admin.location.show')
                        ->with('flash_message', 'Image deleted');
    }


    public function store(Request $request, Location $location)
    {
        
        $request->validate([

            'image' => 'required|mimetypes:image/jpeg,image/gif,image/png
                        |mimes:jpeg,gif,png',

        ]);
        $file = $request->file('image');
        $path = $file->store('public/img');

        //Test file upload
        if (!Storage::exists($path) ) {
            Log::error('Image file failed to upload');
            abort(500, 'File failed to upload');
        }


        $new = new Image;
        $size = $file->getSize();

        //Set image file size
        $new->size = ($size >= 1048576 ? round($size / 1048576) . ' MB':
                    ($size >= 1024 ? round($size / 1024) . ' KB': 
                    $new->size = $size . ' Bytes'));

        //Storage path
        $new->path = $path;

        //public path
        $new->public_path = substr($path, 6);

        $new->type = $file->getMimeType();
        $new->name = $file->getClientOriginalName();

        $location->images()->save($new);

        return redirect()->route('admin.location.show')
                        ->with('flash_message', 'Sucessfully Uploaded ' . $new->name);
    }

}

