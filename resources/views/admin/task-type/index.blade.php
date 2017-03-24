@extends('base')

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12 form-group">
<div class="x_panel">
                  <div class="x_title">
                    <h2>Task Types <small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <a href="{{ URL::to('/admin/task-type/create') }}" class="btn btn-default">Add new Task Type</a>
                  <div class="x_content" style="display: block;">

                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 20%">Type Name</th>
                            <th style="width: 20%">Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($taskTypes as $type)
                          <tr>
                            <td>{{$type->id}}</td>
                            <td>
                              <a>{{$type->name}}</a>
                              <br>
                              <small>Created {{$type->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                              <a href="{{ URL::to('admin/task-type/'.$type->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              {{ Form::open(['route' => ['task-type.destroy', $type->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                              <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                              {{ Form::close() }}
                              </li>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- end project list -->

                  </div>
                </div>
@endsection
