<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class AdminLocationController extends Controller
{
    public function show()
    {

        $locations = Location::all();
        return view('adminLocations.show', compact('locations'));

    }

    public function create()
    {
        return view('adminLocations.create');
    }

    public function edit(Location $location)
    {
        return view('adminLocations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $location->update($request->all());

        return redirect()->route('admin.location.show')
                ->with('flash_message', 'Location '. $location->name . ' updated');
    }

    public function store(Request $request)
    {
        $new = new Location;
        $new->name = $request->name;
        $new->depth = 1;
        $new->save();

        return redirect()->route('admin.location.show')
                ->with('flash_message', 'Location' . $new->name . 'created');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('admin.location.show')
                ->with('flash_message', 'Location' . $location->name . ' deleted');

    }
}
