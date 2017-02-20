@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2>Priority <small>Admin</small></h2>
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
                    @component('component.alert')
                    @endcomponent
                  </div>
                  <a href="{{ URL::to('/admin/priority/create') }}" class="btn btn-default">Add new Priority</a>
                  <div class="x_content" style="display: block;">
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 20%">Priority Name</th>
                            <th style="width: 20%">Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($priorities as $priority)
                          <tr>
                            <td>{{$priority->id}}</td>
                            <td>
                              <a>{{$priority->label}}</a>
                              <br>
                              <small>Created {{$priority->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                              <a href="{{ URL::to('admin/priority/'.$priority->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="{{ URL::to('admin/priority/'.$priority->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              {{ Form::open(['route' => ['priority.destroy', $priority->id], 'method' => 'delete', 'style'=>'display: inline']) }}
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