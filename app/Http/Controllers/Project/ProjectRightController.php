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
        $project = Project::find($id);
        $roles = Role::where('account_id', Auth::user()->current_acc)->get();
        $projectRights = $this->service->getProjectRights($id);
        $fieldRights = $this->service->getFieldRights($id);
        $viewStyle = ' min-width: ' . count($roles) * 216 . 'px';
        $view = View::make('project.rights.index')
                    ->with('project',$project)->with('roles', $roles)
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
        return View::make('project.rights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($id, Request $request)
    {
        //dd(Input::get('project_right'));
        $this->service->storeProjectRights($id, Input::get('project_right'));
        $this->service->storeFieldRights($id, Input::get('field_right'));

        $request->session()->flash('alert-success', 'Roles successfuly updated!');
        return Redirect::to('project-rights/' . $id);
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
        return Redirect::to('help');
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
        return Redirect::to('help');
    }

}
