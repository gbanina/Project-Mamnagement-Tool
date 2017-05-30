<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
Use Redirect;
use App\Models\Dashboard;
use App\Models\Project;
use App\Providers\ProjectServiceProvider;
use App\Providers\BoardServiceProvider;
use Session;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBoard;
use App\Models\UserPreference;

class BoardController extends BaseController {

    protected $service;

    public function __construct(){
        $this->service = new BoardServiceProvider();
    }

    public function index()
    {
        $boards = $this->service->all()->get();
         $preference = UserPreference::firstOrNew(['user_id' => Auth::user()->id,
                                                  'account_id' => Auth::user()->current_acc,
                                                  'key' => 'last_bord'], ['value' => $boards->first()->id]);
        $preference->value = $boards->first()->id;
        $preference->save();

        $view = View::make('board.index')->with('boards', $boards);
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $projects = Project::where('account_id', Auth::user()->current_acc)
                            ->pluck('name', 'id')->prepend('Choose project', '');
        return View::make('board.create')->with('projects', $projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreBoard $request)
    {
        $board = new Dashboard();
        $board->account_id = Auth::user()->current_acc;
        $board->project_id = Input::get('project_id');
        $board->user_id = Auth::user()->id;
        $board->title =Input::get('title');
        $board->content =Input::get('content');
        $board->editable = 'Y';

        $board->save();

        $request->session()->flash('alert-success', 'Board successful created!');
        return Redirect::to('board');
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
        if($board->editable != 'Y' || $board->user->id != Auth::user()->id) return Redirect::back();
        return View::make('board.edit')->with('projects', $projects)->with('board', $board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StoreBoard $request)
    {
        $board = Dashboard::find($id);
        $board->project_id = Input::get('project_id');
        $board->user_id = Auth::user()->id;
        $board->title =Input::get('title');
        $board->content =Input::get('content');
        $board->save();

        $request->session()->flash('alert-success', 'Board successful updated!');
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
        $request->session()->flash('alert-success', 'Board was successful deleted!');
        return Redirect::to('board');
    }
}
