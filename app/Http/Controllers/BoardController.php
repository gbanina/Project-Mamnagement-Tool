<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
Use Redirect;
use App\Models\Dashboard;
use App\Models\Project;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BoardController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $boards = Dashboard::where('account_id', 1)->orderBy('id', 'desc')->get();
        $view = View::make('board.index')->with('boards', $boards);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $projects = Project::all()->pluck('name', 'id')->prepend('Choose project', '');
        return View::make('board.create')->with('projects', $projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'priority-name' => 'required',
            'project_id' => 'required',
            'content' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $board = new Dashboard();
        $board->account_id = 1;
        $board->project_id = Input::get('project_id');
        $board->user_id = Auth::user()->id;
        $board->title =Input::get('title');
        $board->content =Input::get('content');

        $board->save();

        $request->session()->flash('alert-success', 'News successful created!');
        return Redirect::to('board');
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
        $projects = Project::all()->pluck('name', 'id')->prepend('Choose project', '');
        $board = Dashboard::find($id);
        return View::make('board.edit')->with('projects', $projects)->with('board', $board);
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
            'priority-name' => 'required',
            'project_id' => 'required',
            'content' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $board = Dashboard::find($id);
        $board->project_id = Input::get('project_id');
        $board->user_id = Auth::user()->id;
        $board->title =Input::get('title');
        $board->content =Input::get('content');
        $board->save();

        $request->session()->flash('alert-success', 'News successful updated!');
        return Redirect::to('board');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $request->session()->flash('alert-success', 'dashboard : '.''.' was successful deleted!');
        return Redirect::to('board');
    }

}
