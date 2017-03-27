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

              <div class="x_content">
                <div class="row">
                {!! Form::model($task, array('route' => array('task.update', $task->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('name', $task->name, array($global_css, 'required' => 'required', 'class' => 'form-control ','placeholder'=>'Task Name')) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Responsible</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            {{ Form::select('responsible_id', $users, '', array($global_css,'id' => 'responsible_id', 'class' => 'form-control', 'required')) }}
                            <a id="add_responsible" class="btn btn-default">Add</a>
                          </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <div id="responsible_container">
                                @foreach($responsibles as $key=>$responsible)
                                <div id="responsible_item_{{$responsible->user->id}}">
                                  {{$responsible->user->name}} <a href="#" onClick="removeUser({{$responsible->user->id}})"><i class="fa fa-remove"></i></a>
                                  {{ Form::hidden('responsible_user[' . $responsible->user->id. ']', $responsible->user->id) }}
                                </div>
                                @endforeach
                              </div>
                            </div>
                          </div>

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('status_id', $status, $task->status_id, array($global_css, 'class' => 'form-control', 'required')) }}
                        </div>

                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Priority</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('priority_id', $priorities, $task->priority_id, array($global_css, 'class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::textarea('description', $task->description, [$global_css, 'rows'=> '8', 'class' => 'resizable_textarea form-control']) }}
                        </div>
                      </div>
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12"></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <a href="{{ URL::to('project/'.$task->projects_id.'/edit') }}" class="btn btn-primary" type="button">Cancel</a>
                          {!! Form::submit('Submit', array($global_css, 'class' => 'btn btn-success')) !!}
                        </div>
                      </div>
                  </div>

                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {!! Form::text('estimated_start_date', $task->estimatedStartDate, array($global_css, 'class' => 'form-control has-feedback-left datepicket_component')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>

                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('estimated_end_date', $task->estimatedEndDate, array($global_css, 'class' => 'form-control has-feedback-left datepicket_component')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Cost</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::number('estimated_cost', $task->estimated_cost, array( $global_css, 'class' => 'form-control ')) !!}
                        </div>
                      </div>
                      @include('task.additional-fields')
                  </div>
                {!! Form::close() !!}

                </div>
              </div>
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
    <script>
    var resp = [];
@foreach($usersO as $user)
      resp[{{$user->id}}] = '{{$user->name}}';
    @endforeach
      $( "#add_responsible" ).click(function() {
         var id = $('#responsible_id').val();
         if ( $( '#responsible_item_'+id ).length == '0') {
            var str = '<div id="responsible_item_'+id+'">';
             str += resp[id] + '<i class="fa fa-remove"></i>';
             str +=  '<input name="responsible_user['+id+']" type="hidden" value="'+id+'">';
             str += '</div>';
             $( "#responsible_container" ).append( str );
         }else{
          alert('User already in the list!');
         }
        });
      function removeUser(id){
        $( '#responsible_item_'+id ).remove();
      }
    </script>
@endsection
