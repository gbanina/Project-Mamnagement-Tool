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
              <div class="x_title">
                <h2><strong>{{$task->type}}</strong> in <strong><a href="{{ URL::to('project/'.$task->project->id.'/edit') }}">{{$task->project->name}}</a></strong> (Edit)</h2>
                <div class="clearfix"></div>
              </div>
              {!! Form::model($task, array('route' => array('task.update', $task->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
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
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">{{$field['field']->label}}</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12 possibly-hide">
                                          @component('component.additional-field-edit', ['task' => $task,
                                                                                    'field' => $field,
                                                                                    'id' => $field['field']->id,
                                                                                    'global_css' => '',
                                                                                    'users' => $users,
                                                                                    'usersO' => $usersO,
                                                                                    'status' => $status,
                                                                                    'priorities' => $priorities,
                                                                                    'types' => $types,
                                                                                    'responsibles' => $responsibles])
                                          @endcomponent
                                        </div>
                                      </div>
                                @endforeach
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endforeach
                    <div class="col-md-8 col-sm-8 col-xs-12">
                          <a href="{{ URL::to('project/'.$task->project_id.'/edit') }}" class="btn btn-primary" type="button">Cancel</a>
                          {!! Form::submit('Submit', array($global_css, 'class' => 'btn btn-success')) !!}
                    </div>
                  </div>


              <!-- Generate custom form here -->


              </div>
              {!! Form::close() !!}
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                    @component('component.comments', ['id' => $task->id, 'type' => 'TASK', 'comments' => $comments])
                    @endcomponent
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                    @include('task.work')
                  </div>
          <!-- tu -->
        </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
