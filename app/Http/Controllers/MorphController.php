<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
use Redirect;
use App\Models\UserAccounts;
use App\Providers\MorphingServiceProvider;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class MorphController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->service = new MorphingServiceProvider();
    }

    public function switchTo($roleId)
    {
        $this->middleware('admin_access');
        // fill user acc to morph database table
        $this->service->create();
        // assume role
        $this->service->apply($roleId);
        //redirect
        return Redirect::back();
    }
    public function returnFromMorph()
    {
        //check if user is morphing
        $this->service->return();
        return Redirect::back();
    }
}
