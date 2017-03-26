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
        $roles = Role::where('account_id', Auth::user()->current_acc)->get();
        $projects = $this->service->getProjects();

        $projectRights = array();
        $fieldRights = array();

        foreach($projects as $project){
            $projectRights[$project->id] = $this->service->getProjectRights($project->id);
            $fieldRights[$project->id] = $this->service->getFieldRights($project->id);
        }

        $viewStyle = ' min-width: ' . count($roles) * 216 . 'px';

        $view = View::make('admin.right.index')->with('projects',$projects)->with('roles', $roles)
                        ->with('project_rights', $projectRights)->with('viewStyle', $viewStyle)
                            ->with('field_rights', $fieldRights);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return View::make('admin.right.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $project_right = Input::get('project_right');
        $field_right = Input::get('field_right');

        foreach ($projects = $this->service->getProjects() as $project) {
            $this->service->storeProjectRights($project->id, $project_right[$project->id]);
            $this->service->storeFieldRights($project->id, $field_right[$project->id]);
        }
        $request->session()->flash('alert-success', 'Rights successfuly updated!');
        return Redirect::to('admin/right');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $request->session()->flash('alert-success', 'Help : '.''.' was successful updated!');
        return Redirect::to('admin/right');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $request->session()->flash('alert-success', 'Help : '.''.' was successful deleted!');
        return Redirect::to('admin/right');
    }

}
