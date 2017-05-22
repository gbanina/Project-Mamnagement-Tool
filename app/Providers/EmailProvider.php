<?php

namespace App\Providers;
use Mail;
use Auth;
use Illuminate\Support\ServiceProvider;

class EmailProvider extends ServiceProvider
{
    public function __construct(){
    }

    public function createAttribute($email, $name, $accept_url)
    {
        $data = [
            'name' => $name,
            'inviter' => Auth::user()->name,
            'team' => Auth::user()->currentacc->name,
            'accept' => $accept_url,
        ];

        Mail::send('email.send', $data , function ($message) use ($email)
        {
            $message->subject('Welcome to the Teambiosis');
            $message->from('postman@teambiosis.com', 'Teambiosis');
            $message->to($email);
        });
    }
    public function sendAcctivation($email, $name, $url)
    {
        $data = [
            'name' => $name,
            'url' => $url,
        ];

        Mail::send('email.activate', $data , function ($message) use ($email)
        {
            $message->subject('Welcome to the Teambiosis');
            $message->from('postman@teambiosis.com', 'Teambiosis');
            $message->to($email);
        });
    }
}
