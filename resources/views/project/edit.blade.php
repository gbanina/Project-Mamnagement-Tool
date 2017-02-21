
@extends('base')

@section('content')
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Project <small>Projects</small></h2>
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

       <div class="">
                      {!! Form::model($project, array('route' => array('project.update', $project->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
            <div class="clearfix"></div>


            <div class="row">
              <div class="col-md-6 col-xs-12">

                <div class="x_panel">
                  <div class="x_title">
                    <h2>General</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>


                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('project_name', $project->name, array('required' => 'required', 'class' => 'form-control ','placeholder'=>'Project Name')) !!}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Manager</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        {{ Form::select('project_manager', $users, $project_manager, array('class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_type', $projectTypes, $project->project_types_id, array('onchange' => 'refreshTaskTypes()', 'id' => 'project_type', 'class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Default Responsible</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {{ Form::select('default_responsible', $users, $project->default_responsible, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Task Types</label>
                        <label class="data-label col-md-8 col-sm-8 col-xs-12">
                          <div id="task_type_div">Task, Issue, Bug, Epic, Idea <br></div>
                            <!--<a href="" style="margin-bottom: 5px" class="btn btn-primary btn-xs">Edit</a>-->
                        </label>
                      </div>

                      <div class="ln_solid"></div>
                        <div class="btn-group">
                          <button class="btn btn-default" type="button">Permissions</button>
                          <button class="btn btn-default" type="button">Versions</button>
                          <button class="btn btn-default" type="button">Cmponents</button>
                        </div>
                  </div>
                </div>


              </div>

              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dates & Costs</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {!! Form::text('estimated_start_date', $project->estimatedStartDate, array('disabled', 'id' => 'single_cal1', 'class' => 'form-control has-feedback-left')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status1" class="sr-only">(success)</span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {!! Form::text('estimated_end_date', $project->estimatedEndtDate, array('disabled', 'id' => 'single_cal3', 'class' => 'form-control has-feedback-left')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess_status" class="sr-only">(success)</span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Real Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {!! Form::text('real_start_date', $project->realStartDate, array('disabled', 'id' => 'single_cal3', 'class' => 'form-control has-feedback-left')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Real End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {!! Form::text('real_end_date', $project->realEndDate, array('disabled', 'id' => 'single_cal3', 'class' => 'form-control has-feedback-left')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Cost</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('estimated_cost', $project->estimatedCost, array('required' => 'required', 'class' => 'form-control ')) !!}
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Real Cost</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input disabled type="number" class="form-control" placeholder="Real Cost" value="N/A">
                        </div>
                      </div>
                  </div>
                </div>
              </div>

            </div>
                  @if($errors->count() != 0):
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                                {!! var_dump($errors->count()) !!}
                            </div>
                        </div>
                  @endif
                  <div class="x_content">
                    <br>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                          <a href="{{ URL::to('project') }}" class="btn btn-primary" type="button">Cancel</a>
                          {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                        </div>
                      </div>
                      </div>
                {!! Form::close() !!}
                    </div>
                </div>
                @include('project.tasks')
              </div>
            </div>
        </div>

@endsection

@section('js_include')
    <script>
      function refreshTaskTypes(){
        var projectTypeID = $( "#project_type" ).val();
        var taskTypes = [];
        taskTypes[0] = '';
        $( "#task_type_buttons" ).html('');
        $( "#task_type_div" ).html('');
        @foreach($taskTypes as $id=>$pType)
          taskTypes[{{$id}}] = [
          @foreach($pType as $tType)
             ['{{$tType['name']}}', '{{$tType['id']}}'],
          @endforeach
          ];
        @endforeach
        for (var i in taskTypes[projectTypeID]) {
          $( "#task_type_div" ).append(taskTypes[projectTypeID][i][0] + ', ');
          $( "#task_type_buttons" ).append('<a href="{{ URL::to('task/create') }}?type='+taskTypes[projectTypeID][i][1]+'&p={{$project->id}}" class="btn btn-default" type="button">Add new '+taskTypes[projectTypeID][i][0]+'</a>');
        }
      }
      refreshTaskTypes();
    </script>
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
