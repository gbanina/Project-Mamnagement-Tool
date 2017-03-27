@extends('base')

@section('content')
<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tasks</h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tasks</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-md-2 pull-left">
                    <a href="#" id="add_new_button" disabled class="btn btn-default">Add new Task</a>
                  </div>
                  <div class="col-md-2 pull-left">
                    {{ Form::select('project_id', $projects, '', array('style' => 'max-width: 250px;','id'=>'project_id', 'class' => 'form-control', 'required')) }}
                  </div>
                  <div class="x_content" style="display: block;">
                    <p>Task listings for all the projects inyour current organisation</p>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Task Name</th>
                          <th>Team Members</th>
                          <th>Project</th>
                          <th>Type</th>
                          <th style="width: 20%">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                          <td>{{$task->internal_id}}</td>
                          <td>
                            <a>{{$task->name}}</a>
                            <br>
                            <small>Created {{$task->created_at}}</small>
                          </td>
                          <td>
                            <ul class="list-inline">
                              @foreach($task->responsibleUsers as $user)
                              <li>
                                <img src="{{ URL::to('images/' . $user->avatar) }}" class="avatar" alt="Avatar">
                              </li>
                              @endforeach
                            </ul>
                          </td>
                          <td class="project_progress">
                            <a href="{{ URL::to('project/'. $task->project_id . '/edit') }}">{{$task->project->name}}</a>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">{{ $task->type }}</button>
                          </td>
                          <td>
                            <li style="display: inline-block;">
                              <a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              @if($task->permission == 'DEL')
                                @component('component.delete-button', ['route' => 'task.destroy', 'id' => $task->id])
                                  Delete
                                @endcomponent
                              @endif
                            </li>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <!-- end project list -->
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('js_include')
    <script>
      $( "#project_id" ).change(function() {
         $('#add_new_button').removeAttr('disabled');
         $('#add_new_button').attr('href','{{ URL::to('task\/create') }}' + '?p=' + this.value);
        });
    </script>
@endsection
