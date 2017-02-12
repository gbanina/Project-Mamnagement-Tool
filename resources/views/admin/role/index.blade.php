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
                    <a href="{{ URL::to('/admin/role/create') }}" class="btn btn-default">Add new Role</a>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($roles as $role)
                        <tr>
                          <th scope="row">{{$role->id}}</th>
                          <td>{{$role->name}}</td>
                          <td>
                            <a class="fa fa-edit" href="{{ URL::to('/admin/role/'.$role->id.'/edit') }}"></a>
                            <a class="fa fa-remove" href="#"></a>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
@endsection
