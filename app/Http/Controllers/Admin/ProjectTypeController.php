<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\ProjectTypes;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProjectTypeController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pt = ProjectTypes::all();
        $view = View::make('admin.project-type.index')->with('projectTypes', $pt);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.project-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'type-label' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $pt = new ProjectTypes();
        $pt->accounts_id = 1;
        $pt->label =Input::get('type-label');
        $pt->save();

        return Redirect::to('admin/project-type');
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
        $pt = ProjectTypes::find($id);

        $view = View::make('admin.project-type.edit')->with('projectType', $pt);
        return $view;
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
            'type-label' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $pt = ProjectTypes::find($id);
        $pt->label =Input::get('type-label');
        $pt->update();

        return Redirect::to('admin/project-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}
