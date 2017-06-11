<?php

namespace App\Http\Controllers\Project;

use View;
Use Redirect;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use App\Providers\ProjectServiceProvider;
use Auth;
use WebComponents;
use Illuminate\Http\Request;

class ProjectController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->service = new ProjectServiceProvider(Auth::user());
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('project.index')->with('projects', $this->service->all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $fields = $this->service->fillCreate();
        return View::make('project.create')->with('users',$fields['users'])->with('projectTypes',$fields['projectTypes']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($account, Request $request)
    {
        $this->service->store(Input::all());
        $request->session()->flash('alert-success', 'Project was successful created!');

        return Redirect::to($account . '/project');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($account, $id)
    {
        $fields = $this->service->edit($id);
        return View::make('project.edit')->with('users', $fields['users'])
                                            ->with('projectTypes', $fields['typesSelect'])
                                                ->with('project_manager', $fields['projectManager'])
                                                    ->with('project', $fields['project'])->with('comments', $fields['comments'])
                                                        ->with('taskTypes', $fields['taskTypes'])
                                                            ->with('global_css', $fields['global_css']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($account, $id, Request $request)
    {
        $fields = $this->service->update($id, Input::all());
        $request->session()->flash('alert-success', 'Project was successfuly updated!');

        return Redirect::to($account . '/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($account, $id, Request $request)
    {
        $this->service->delete($id);
        $request->session()->flash('alert-success', 'Project was successfuly deleted!');
        return Redirect::to($account . '/project');
    }
}
