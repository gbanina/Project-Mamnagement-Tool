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
                              <th>Role Name</th>
                              <th style="width: 70px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($roles as $role)
                            <tr>
                              <td>
                                <a href="{{ URL::to('/admin/role/'.$role->id.'/edit') }}">{{$role->name}}</a>
                                <br>
                                <small>Created {{$role->created_at}}</small>
                              </td>
                              <td>
                                <li style="display: inline-block;">
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
