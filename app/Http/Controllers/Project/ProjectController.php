<?php

namespace App\Http\Controllers\Project;

use DB;
use View;
Use Redirect;
use App\User;
use App\Models\Project;
use App\Models\ProjectTypes;
use App\Models\UserProject;
use App\Models\Comment;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Providers\ProjectServiceProvider;
use Auth;

class ProjectController extends BaseController {


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $service = new ProjectServiceProvider(Auth::user());
        $view = View::make('project.index')->with('projects', $service->all());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $service = new ProjectServiceProvider(Auth::user());
        $fields = $service->fillCreate();
        return View::make('project.create')->with('users',$fields['users'])->with('projectTypes',$fields['projectTypes']);
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
        $service = new ProjectServiceProvider(Auth::user());
        $service->store(Input::all());

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
        $service = new ProjectServiceProvider(Auth::user());
        $fields = $service->edit($id);
        $comments = Comment::where('entity_id', $id)->where('entity_type', 'PROJECT')->orderBy('id', 'desc')->get();


        return View::make('project.edit')->with('users', $fields['users'])
                                            ->with('projectTypes', $fields['typesSelect'])
                                                ->with('project_manager', $fields['projectManager'])
                                                    ->with('project', $fields['project'])->with('comments', $comments)
                                                        ->with('taskTypes', $fields['taskTypes']);
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

        $service = new ProjectServiceProvider(Auth::user());
        $fields = $service->update($id, Input::all());

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
        $service = new ProjectServiceProvider(Auth::user());
        $service->delete($id);

        return Redirect::to('project');
    }

}
