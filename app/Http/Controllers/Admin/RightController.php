<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use View;
use Redirect;
use Session;
use App\Models\Role;
use App\Providers\ProjectRightProvider;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RightController extends BaseController {
    protected $service;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service = new ProjectRightProvider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = $this->service->all();

        $view = View::make('admin.right.index')->with('projects',$data['projects'])
                    ->with('roles', $data['roles'])->with('project_rights', $data['projectRights'])
                        ->with('viewStyle', $data['viewStyle'])->with('field_rights', $data['fieldRights']);
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->service->storeAll(Input::get('project_right'), Input::get('field_right'));
        $request->session()->flash('alert-success', 'Rights successfuly updated!');

        return Redirect::to('admin/right');
    }
}
