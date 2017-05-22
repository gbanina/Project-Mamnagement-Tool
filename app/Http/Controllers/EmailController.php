<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function send(Request $request){

         $data = [
                    'name' => 'Goran Banina',
                    'inviter' => 'John Dow',
                    'team' => 'SuperKewlAwsome',
                    'accept' => 'accept_url',
                ];


        Mail::send('email.send', $data , function ($message)
        {
            $message->subject('Welcome to the Teambiosis');
            $message->from('postman@teambiosis.com', 'Teambiosis');
            $message->to('gbanina@gmail.com');

        });

        return response()->json(['message' => 'Request completed']);
    }
}
