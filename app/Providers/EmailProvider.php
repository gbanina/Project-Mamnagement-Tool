<?php

namespace App\Providers;
use Mail;
use Auth;
use URL;
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
            $message->from('postmaster@app.teambiosis.com', 'Teambiosis');
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
            $message->from('postmaster@app.teambiosis.com', 'Teambiosis');
            $message->to($email);
        });
    }
    public function taskAssign($email, $name, $taskName,$type, $url)
    {
        $data = [
            'name' => $name,
            'creator' => Auth::user()->name,
            'taskName' => $taskName,
            'type' => $type,
            'url' => $url,
        ];

        Mail::send('email.assigned', $data , function ($message) use ($email, $taskName)
        {
            $message->subject('Assigned to You: ' . $taskName);
            $message->from('postmaster@app.teambiosis.com', 'Teambiosis');
            $message->to($email);
        });
    }
    public function newBoard($email, $name, $boardName, $description)
    {
        $data = [
            'name' => $name,
            'creator' => Auth::user()->name,
            'boardName' => $boardName,
            'description' => $description,
            'url' => URL::to('/'),
        ];

        Mail::send('email.newboard', $data , function ($message) use ($email, $boardName)
        {
            $message->subject('New board message: ' . $boardName);
            $message->from('postmaster@app.teambiosis.com', 'Teambiosis');
            $message->to($email);
        });
    }
}
