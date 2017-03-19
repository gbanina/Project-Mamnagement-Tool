<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\TaskField;
use App\Helpers\PMTypesHelper;
use App\Providers\Admin\TaskFieldServiceProvider;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaskFieldController extends BaseController {

    protected $service;

    public function __construct()
    {
        $this->middleware('admin_access');
        $this->service = new TaskFieldServiceProvider();
    }

    public function index()
    {
        $view = View::make('admin.field.index')
            ->with('fields', $this->service->all())
            ->with('typeSelect', PMTypesHelper::fieldTypeSelect());

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.field.create')
                ->with('typeSelect', PMTypesHelper::fieldTypeSelect());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'field-name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        $this->service->store(Input::all());

        $request->session()->flash('alert-success', 'Field was successfuly created!');
        return Redirect::to('admin/field');
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
        $view = View::make('admin.field.edit')
                ->with('field', $this->service->getTaskField($id))
                    ->with('typeSelect', PMTypesHelper::fieldTypeSelect());

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $rules = array(
            'field-name' => 'required',
            'field-type' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        $this->service->update($id, Input::all());
        $request->session()->flash('alert-success', 'Task Field was successfuly updated!');
        return Redirect::to('admin/field');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $this->service->destroy($id);
        $request->session()->flash('alert-success', 'Task Field was successfuly deleted!');

        return Redirect::to('admin/field');
    }

}
