@extends('base')

@section('content')
<div class="col-md-9 col-sm-12 col-xs-12 form-group">
    <div class="x_panel">
                  <div class="x_title">
                    <h2>Task Views <small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>

                   <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 2%">#</th>
                            <th style="width: 30%">View Name</th>
                            <th style="width: 40%">Edit</th>
                            <th style="width: 10%">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        {!! Form::open(array('url' => 'admin/task-view', 'class' => 'form-horizontal form-label-left')) !!}
                        <tr>
                         <td></td>
                         <td>
                            {!! Form::text('view-name', '', array('required' => 'required', 'class' => 'form-control')) !!}
                         </td>
                         <td>
                         <button type="submit" style="margin-top: 7px;" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</button>
                         </td>
                         <td>
                          <!--status-->
                         </td>
                        </tr>
                        {!! Form::close() !!}

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
                              <a href="{{ URL::to('admin/task-view/duplicate/'. $type->id) }}" class="btn btn-success btn-xs"><i class="fa fa-copy"></i> Duplicate </a>
                              <a href="{{ URL::to('admin/task-view/'.$type->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                @component('component.delete-button', ['route' => 'task-view.destroy', 'id' => $type->id])
                                  Delete
                                @endcomponent
                              </li>
                            </td>
                            <td>
                              {{$type->status}}
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
