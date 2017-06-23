<?php

namespace App\Http\Controllers\My;

use Auth;
use Redirect;
use App\Models\WorkingOn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\My\WorkingOnService;

class WorkingOnController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new WorkingOnService();
    }
    public function start($account, $taskId, Request $request)
    {

        $this->service->closeActive();
        $this->service->new($taskId);

        return Redirect::back();
    }

    public function end($account, $taskId, Request $request)
    {
        $this->service->closeActive();

        return Redirect::back();
    }
}
