@extends('base')

@section('content')
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Task Types</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ URL::to('/admin/task-type/create') }}" class="btn btn-default">Add new Task Type</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                   <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th>Type Name</th>
                            <th style="width: 70px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($taskTypes as $type)
                          <tr><td>
                              <a href="{{ URL::to('admin/task-type/'.$type->id.'/edit') }}">{{$type->name}}</a>
                              <br>
                              <small>Created {{$type->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                                @component('component.delete-button', ['route' => 'task-type.destroy', 'id' => $type->id])
                                  Delete
                                @endcomponent
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
              </div>
@endsection
