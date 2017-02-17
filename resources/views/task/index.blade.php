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
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
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
                          <td>{{$task->id}}</td>
                          <td>
                            <a>{{$task->name}}</a>
                            <br>
                            <small>Created {{$task->created_at}}</small>
                          </td>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="images/user.png" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td class="project_progress">
                            {{$task->project}}
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">{{ $task->type }}</button>
                          </td>
                          <td>
                            <li style="display: inline-block;">
                            <a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            {{ Form::open(['route' => ['task.destroy', $task->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                            {{ Form::close() }}
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
