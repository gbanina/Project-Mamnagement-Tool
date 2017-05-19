<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function send(Request $request){
         $title = 'test title';//$request->input('title');
         $content = 'test content';//$request->input('content');

        Mail::send('email.send', ['title' => $title, 'content' => $content], function ($message)
        {

            $message->from('me@gmail.com', 'Teambiosis');

            $message->to('gbanina@gmail.com');

        });

        return response()->json(['message' => 'Request completed']);
    }
}
