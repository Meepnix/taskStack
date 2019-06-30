<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Label;

class AdminLabelController extends Controller
{
    
    /** 
     * Show task list
     * 
     * @param  void
     * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $labels = Label::all();
        return view('adminLabels.show', compact('labels'));
    }

    public function create()
    {

        return view('adminLabels.create');

    }

    public function destroy(Label $label)
    {
        $label->delete();
        return redirect()->route('admin.label.show')->with('flash_message', $label->name . ' Label deleted');
    }


    public function edit(Label $label)
    {

        return view('adminLabels.edit', compact('label'));
    }

    

    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required',
            'label_fmt' => 'required'

        ]);


        $new = new Label;

        $new->name = $request->name;

        $new->theme = $request->label_fmt;

        $new->html = $this->getThemeHTML($request->label_fmt, $request->name);

        $new->save();

        return redirect()->route('admin.label.show')->with('flash_message', 'Label created');

    }



    public function update(Request $request, Label $label)
    {

        $request->validate([

            'name' => 'required',
            'label_fmt' => 'required'

        ]);


        $label->name = $request->name;

        $label->theme = $request->label_fmt;

        $label->html = $this->getThemeHTML($request->label_fmt, $request->name);

        $label->save();

        return redirect()->route('admin.label.show')->with('flash_message', 'Label created');

    }

    /** 
     * Return theme tag html
     * 
     * @param  integer/string
     * @return string
    */

    private function getThemeHTML ($theme, $name)
    {

        switch ($theme) {

            case 0:
                return '<h5><span class="badge badge-primary">' . $name . '</span></h5>';
                break;

            case 1:
                return '<h5><span class="badge badge-secondary">' . $name . '</span></h5>';
                break;

            case 2:
                return '<h5><span class="badge badge-success">' . $name . '</span></h5>';
                break;

            case 3:
                return '<h5><span class="badge badge-danger">' . $name . '</span></h5>';
                break;

            case 4:
                return '<h5><span class="badge badge-warning">' . $name . '</span></h5>';
                break;
            
            case 5:
                return '<h5><span class="badge badge-info">' . $name . '</span></h5>';
                break;
        }



    }


}
