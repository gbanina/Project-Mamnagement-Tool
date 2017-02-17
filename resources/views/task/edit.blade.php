@extends('base')

@section('content')
        <div class="">
            <div class="clearfix"></div>

            @if (count($errors) > 0)
              <div class="row">
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                </div>
            @endif

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
              <div class="x_title">
                <h2>Edit Task</h2>
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

                <div class="row">
                {!! Form::model($task, array('route' => array('task.update', $task->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_id', $projects, $task->projects_id, array('class' => 'form-control' , 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('name', $task->name, array('required' => 'required', 'class' => 'form-control ','placeholder'=>'Task Name')) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('type_id', $types, $task->task_types_id, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Responsible</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('responsible_id', $users, $task->responsible_id, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('status_id', $status, $task->status_id, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Priority</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('priority_id', $priorities, $task->priority_id, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Description</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::textarea('description', $task->description, ['rows'=> '8', 'class' => 'resizable_textarea form-control']) }}
                        </div>
                      </div>
                  </div>

                  <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Created by</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('created_by', $users, $task->created_by, array('disabled', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Creation Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input disabled class="form-control " placeholder="N/A" name="project_name" type="text" value="">
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Real Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input disabled class="form-control " placeholder="N/A" name="project_name" type="text" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Real End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input disabled class="form-control " placeholder="N/A" name="project_name" type="text" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Start Date (Missing : TODO!!!)</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {!! Form::text('estimated_start_date', '11/11/2017', array('id' => 'single_cal3', 'class' => 'form-control has-feedback-left')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated End Date (Missing : TODO!!!)</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('estimated_end_date', '', array('id' => 'single_cal4', 'class' => 'form-control has-feedback-left')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Real cost</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled class="form-control " placeholder="N/A" name="project_name" type="text" value="">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <label class="control-label col-md-6 col-sm-6 col-xs-12">Estimated cost</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::number('estimated_cost', $task->estimated_cost, array( 'class' => 'form-control ')) !!}
                        </div>
                      </div>
                  </div>
                  <div class="clearfix"></div>
                  {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
                  {!! Form::close() !!}
                </div>

              </div>
            </div>
              </div>

            </div>
        </div>



@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
