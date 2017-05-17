<?php

namespace App\Http\Controllers;

use DB;
use View;
Use Redirect;
use Session;
use App\Models\File;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FileController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function upload($taskId, Request $request)
    {
        $name = (Input::file('file')->getClientOriginalName());
        $filePath = $request->file('file')->store('task_files');
        // get file name
        $file = new File();
        $file->task_id = $taskId;
        $file->path = $filePath;
        $file->name = $name;

        $file->save();

        // add comment

        $request->session()->flash('alert-success', 'File successful uploaded!');

        return back();
    }
}
