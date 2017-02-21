<?php

namespace App\Http\Controllers\Project;

use DB;
use View;
Use Redirect;
use App\User;
use App\Models\Project;
use App\Models\ProjectTypes;
use App\Models\UserProject;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Auth;

class ProjectController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::all();
        $view = View::make('project.index')->with('projects',$projects);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $pt = ProjectTypes::all()->pluck('label', 'id')->prepend('Choose Project Type', '');
        return View::make('project.create')->with('users',$users)->with('projectTypes',$pt);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'project_name' => 'required',
            'project_manager' => 'required',
            'default_responsible' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $project = new Project;
        $project->accounts_id = 1;
        $project->project_types_id = Input::get('project_type');
        $project->name = Input::get('project_name');
        $project->default_responsible = Input::get('default_responsible');
        $project->created_by = Auth::user()->id;
        $project->save();

        $up = New UserProject;
        $up->users_id = Input::get('project_manager');
        $up->projects_id = $project->id;
        $up->save();

        return Redirect::to('project');
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
        $project = Project::find($id);
        // TODO : Refactor this
        $projectManager = DB::table('user_projects')->where('projects_id', '=', $project->id)->first();
        if($projectManager == null) $projectManager = '';
        else $projectManager = $projectManager->users_id;

        $users = User::all()->pluck('name', 'id')->prepend('Choose user', '');
        $projectTypes = ProjectTypes::all();
        $taskTypes = array();
        foreach($projectTypes as $type){
            $taskTypes[$type->id] = $type->posibleTaskTypes()->get()->toArray();
        }
        //dd($taskTypes);
        $typesSelect = $projectTypes->pluck('label', 'id')->prepend('Choose Project Type', '');

        return View::make('project.edit')->with('users',$users)
                                            ->with('projectTypes',$typesSelect)
                                                ->with('project_manager', $projectManager)
                                                    ->with('project', $project)->with('taskTypes', $taskTypes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $rules = array(
            'project_name' => 'required',
            'project_manager' => 'required',
            'default_responsible' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $project = Project::find($id);
        $project->accounts_id = 1;
        $project->project_types_id = Input::get('project_type');
        $project->name = Input::get('project_name');
        $project->default_responsible = Input::get('default_responsible');
        $project->update();

        $pm = UserProject::where('projects_id', '=', $id)->first();
        if($pm == null) $pm = new UserProject;
        $pm->projects_id = $id;
        $pm->users_id = Input::get('project_manager');
        $pm->save();

        return Redirect::to('project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return Redirect::to('project');
    }

}
