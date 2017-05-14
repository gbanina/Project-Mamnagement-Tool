@extends('base')

@section('content')

        <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-xs-12">
                            <ul class="stats-overview">
                        <li>
                          <span class="name"> Task ID </span>
                          <span class="value text-success"> {{$task->internal_id}}</span>
                        </li>
                        <li>
                          <span class="name"> Task Type </span>
                          <span class="value text-success"> {{$task->taskType->name}}</span>
                        </li>
                        <li>
                          <span class="name"> Created by </span>
                          <span class="value text-success"> {{$task->createdBy->name}} </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Creation Date</span>
                          <span class="value text-success"> {{$task->createdAt}} </span>
                        </li>
                        <li>
                          <span class="name"> Real Start Date </span>
                          <span class="value text-success"> {{$task->realStartDate}} </span>
                        </li>
                        <li>
                          <span class="name"> Real End Date </span>
                          <span class="value text-success"> {{$task->realEndDate}} </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Real cost</span>
                          <span class="value text-success"> {{$task->realCost}} </span>
                        </li>
                      </ul>
                <div class="x_panel">
                {!! Form::model($task, array('route' => array('task.update', $task->id), 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
              <div class="x_title">
                <h2>
                  <strong>{{$task->type}}</strong> in
                  <strong><a href="{{ URL::to('project/'.$task->project->id.'/edit') }}">{{$task->project->name}}</a></strong>
                  <div class="header-buttons">
                    @if($task->close == 'No')
                      <a href="{{ URL::to('task-close/'.$task->id) }}" class="btn btn-sm btn-primary" type="button">Close</a>
                    @else
                      <a href="{{ URL::to('task-reopen/'.$task->id) }}" class="btn btn-sm btn-primary" type="button">Reopen</a>
                    @endif
                  </div>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                          <a href="#" onClick="goBack()" class="btn btn-default" type="button">Cancel</a>
                          {!! Form::submit('Submit', array($global_css, 'class' => 'btn btn-success')) !!}
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">

              <!-- Generate custom form here -->

                  <div class="x_content usable-fields">
                    @foreach($fields as $rowId => $row)
                      <div id="row_{{$rowId}}" class="view view-first">
                        <div id="cols_{{$rowId}}">
                          @foreach($row as $colId => $col)
                            <div id="col_{{$colId}}_{{$rowId}}" class="col-md-{{(12 / count($row))}} col-sm-12 col-xs-12 form-group">
                                @foreach($col as $field)
                                      <div class="form-group">
                                        @if($field['field']->type != 'COMMENTS' && $field['field']->type != 'WORK')
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">{{$field['field']->label}}</label>
                                          <div class="col-md-8 col-sm-8 col-xs-12 possibly-hide">
                                            @component('component.additional-field-edit', ['task' => $task, 'field' => $field,
                                                                                      'id' => $field['field']->id,
                                                                                      'global_css' => $global_css,
                                                                                      'users' => $users,
                                                                                      'usersO' => $usersO,
                                                                                      'status' => $status,
                                                                                      'priorities' => $priorities,
                                                                                      'types' => $types])
                                            @endcomponent
                                          </div>
                                        @else
                                          <div class="col-md-12 col-sm-12 col-xs-12 possibly-hide">
                                            @component('component.additional-field-edit', ['task' => $task, 'field' => $field['field'],
                                                'id' => $field['field']->id,
                                                'global_css' => $global_css,
                                                'users' => $users,
                                                'usersO' => $usersO,
                                                'status' => $status,
                                                'priorities' => $priorities,
                                                'comments' => $comments,
                                                'types' => $types])
                                            @endcomponent
                                          </div>
                                        @endif
                                      </div>
                                @endforeach
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endforeach
                  </div>
              <!-- Generate custom form here -->
              </div>
              {!! Form::close() !!}
            </div>
          </div>
          <!-- tu -->
        </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
