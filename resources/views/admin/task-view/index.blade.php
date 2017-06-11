@extends('base')

@section('content')
<div class="row">
  <div class="col-md-9 col-sm-12 col-xs-12 form-group">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Task Views</h2>
                    <div class="clearfix"></div>
                  </div>

                   <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th style="width: 150px">Status</th>
                            <th style="width: 160px"></th>
                          </tr>
                        </thead>
                        <tbody>
                        {!! Form::open(array('url' => TMBS::url('admin/task-view'), 'class' => 'form-horizontal form-label-left')) !!}
                        <tr>
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
                            <td>
                              <a href="{{ TMBS::url('admin/task-view/'. $type->id . '/edit') }}">{{$type->name}}</a>
                              <br>
                              <small>Created {{$type->created_at}}</small>
                            </td>
                            <td>
                              {{$type->status}}
                            </td>
                            <td>
                              <li style="display: inline-block;">
                              <a href="{{ TMBS::url('admin/task-view/duplicate/'. $type->id) }}" class="btn btn-success btn-xs">
                                <i class="fa fa-copy"></i> Duplicate
                              </a>
                                @component('component.delete-button', ['url' => 'admin/task-view', 'id' => $type->id])
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
