<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Message;

class MessageController extends Controller
{
    
    public function index()
    {
        //Current user login
        $user = Auth::user();
        $group = $user->groups()->get()->pluck('id');


        $messages = Message::whereIn('group_id', $group)
        
            ->where('enabled', '=', 1)->get();
        

        return response()->json($messages, 200);

    }
}
