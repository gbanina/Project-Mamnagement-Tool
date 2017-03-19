@extends('base')

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12 form-group">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Status <small>Admin</small></h2>
                    <div class="clearfix"></div>
                    @component('component.alert')
                    @endcomponent
                  </div>
                  <a href="{{ URL::to('/admin/status/create') }}" class="btn btn-default">Add new Status</a>
                  <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 20%">Status Name</th>
                            <th style="width: 10%">Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($statuses as $status)
                          <tr>
                            <td>{{$status->id}}</td>
                            <td>
                              <a>{{$status->name}}</a>
                              <br>
                              <small>Created {{$status->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                              <a href="{{ URL::to('admin/status/'.$status->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              {{ Form::open(['route' => ['status.destroy', $status->id], 'method' => 'delete', 'style'=>'display: inline']) }}
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
