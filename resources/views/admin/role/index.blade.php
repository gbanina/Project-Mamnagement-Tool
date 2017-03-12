@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2>Roles <small>Admin</small></h2>
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
                  <div class="x_content">
                      <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                        <a href="{{ URL::to('/admin/role/create') }}" class="btn btn-default">Add new Role</a>
                        <table class="table table-striped projects">
                          <thead>
                            <tr>
                              <th style="width: 1%">#</th>
                              <th style="width: 30%">Role Name</th>
                              <th style="width: 20%"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($roles as $role)
                            <tr>
                              <td>{{$role->id}}</td>
                              <td>
                                <a>{{$role->name}}</a>
                                <br>
                                <small>Created {{$role->created_at}}</small>
                              </td>
                              <td>
                                <li style="display: inline-block;">
                                <a href="{{ URL::to('/admin/role/'.$role->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                <a href="{{ URL::to('/admin/role/'.$role->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                {{ Form::open(['route' => ['role.destroy', $role->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                {{ Form::close() }}
                                </li>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
@endsection
