<?php

namespace App\Http\Controllers\Admin;

use DB;
use View;
Use Redirect;
use App\Models\TaskField;
use App\Helpers\PMTypesHelper;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaskFieldController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tf = TaskField::all();
        $typeSelect = PMTypesHelper::fieldTypeSelect();
        $view = View::make('admin.field.index')
            ->with('fields', $tf)->with('typeSelect', $typeSelect);;
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $typeSelect = PMTypesHelper::fieldTypeSelect();
        return View::make('admin.field.create')->with('typeSelect', $typeSelect);
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

        $tt = new TaskField();
        $tt->accounts_id = 1;
        $tt->label = Input::get('field-name');
        $tt->type = Input::get('field-type');
        $tt->save();
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
        $tt = TaskField::find($id);
        $typeSelect = PMTypesHelper::fieldTypeSelect();
        $view = View::make('admin.field.edit')
                ->with('field', $tt)->with('typeSelect', $typeSelect);
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
        $tf = TaskField::find($id);
        $tf->label = Input::get('field-name');
        $tf->type = Input::get('field-type');
        $tf->save();
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
        $type = TaskField::find($id);
        $type->delete();
        $request->session()->flash('alert-success', 'Task Field was successfuly deleted!');

        return Redirect::to('admin/field');
    }

}
