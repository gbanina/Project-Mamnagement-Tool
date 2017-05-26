@extends('base')

@section('content')
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Roles</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ URL::to('/admin/role/create') }}" class="btn btn-default">Add new Role</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
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
                                <a href="{{ URL::to('/admin/role/'.$role->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                @component('component.delete-button', ['route' => 'role.destroy', 'id' => $role->id])
                                  Delete
                                @endcomponent
                                </li>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
@endsection
