<?php

namespace App\Http\Controllers\Project;

use DB;
use View;
Use Redirect;
use Session;
use Auth;
use App\Models\Project;
use App\Models\Role;
use App\Providers\ProjectRightProvider;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProjectRightController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->service = new ProjectRightProvider();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $fields = $this->service->projectRightsIndex($id);
        $view = View::make('project.rights.index')
                    ->with('project',$fields['project'])->with('roles', $fields['roles'])
                        ->with('project_rights', $fields['projectRights'])->with('viewStyle', $fields['viewStyle'])
                            ->with('field_rights', $fields['fieldRights']);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return View::make('project.rights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($id, Request $request)
    {
        $this->service->projectRightsStore($id, Input::all());
        $request->session()->flash('alert-success', 'Rights successfuly updated!');
        return Redirect::to('project-rights/' . $id);
    }
}
