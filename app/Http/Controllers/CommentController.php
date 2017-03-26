<?php

namespace App\Http\Controllers;

use DB;
use View;
use Auth;
Use Redirect;
use Session;
use App\Models\Comment;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $view = View::make('comment.index');
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return View::make('comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'entity_type' => 'required',
            'entity_id' => 'required',
            'data' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        $comment = new Comment();
        $comment->entity_id = Input::get('entity_id');
        $comment->entity_type =Input::get('entity_type');
        $comment->user_id = Auth::user()->id;
        $comment->type ='COMMENT';
        $comment->data =Input::get('data');

        $comment->save();

        $request->session()->flash('alert-success', 'comment : '.''.' was successful created!');

        //if( null == Input::get('return_to') )
            //abort(403, 'Unauthorized action.');

        return Redirect::back();//Redirect::to(Input::get('return_to'));
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
        $request->session()->flash('alert-success', 'comment : '.''.' was successful updated!');
        return Redirect::to('comment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $comment = Comment::find($id);
        $comment->delete();

        $request->session()->flash('alert-success', 'Comment was successful deleted!');
        return Redirect::back();;
    }

}
