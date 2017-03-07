
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

            <div class="clearfix"></div>


            <div class="row">

              <ul class="stats-overview">
                        <li>
                          <span class="name"> Estimated Start Date </span>
                          <span class="value text-success"> {{$project->estimatedStartDate}} </span>
                        </li>
                        <li>
                          <span class="name"> Estimated End Date </span>
                          <span class="value text-success"> {{$project->estimatedEndDate}} </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Estimated cost</span>
                          <span class="value text-success"> {{$project->estimatedCost}} </span>
                        </li>
                        <li>
                          <span class="name"> Real Start Date </span>
                          <span class="value text-success"> {{$project->realStartDate}} </span>
                        </li>
                        <li>
                          <span class="name"> Real End Date </span>
                          <span class="value text-success"> {{$project->realEndDate}} </span>
                        </li>
                        <li class="hidden-phone">
                          <span class="name"> Real cost</span>
                          <span class="value text-success"> {{$project->realCost}}h </span>
                        </li>
                      </ul>

              <div class="col-md-6 col-xs-12">
{!! Form::model($project, array('route' => array('project.update', $project->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
                <div class="x_panel">
                  <div class="x_title">
                    <h2>General</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <br>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project ID</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('id', $project->internal_id, array('disabled', 'class' => 'form-control ')) !!}
                        </div>
                      </div>

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
                          {{ Form::select('project_type', $projectTypes, $project->project_types_id, array('onchange' => 'refreshTaskTypes()','disabled', 'id' => 'project_type', 'class' => 'form-control')) }}
                          {{ Form::hidden('project_type', $project->project_types_id) }}
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
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
                          <a href="{{ URL::to('project') }}" class="btn btn-primary" type="button">Cancel</a>
                          {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                        <div class="btn-group">
                          <button class="btn btn-default" type="button">Permissions</button>
                          <button class="btn btn-default" type="button">Versions</button>
                          <button class="btn btn-default" type="button">Components</button>
                        </div>
                  </div>
                </div>
{!! Form::close() !!}

<div>

                        <h4>Recent Comments</h4>

                        <!-- end of user messages -->
                        <ul class="messages">
                          <li>
                            <img src="{{ URL::to('images/img.jpg') }}" class="avatar" alt="Avatar">
                            <div class="message_date">
                              <h3 class="date text-info">24</h3>
                              <p class="month">May</p>
                            </div>
                            <div class="message_wrapper">
                              <h4 class="heading">Desmond Davison</h4>
                              <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                              <br>
                              <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                              </p>
                            </div>
                          </li>
                          <li>
                            <img src="{{ URL::to('images/img.jpg') }}" class="avatar" alt="Avatar">
                            <div class="message_date">
                              <h3 class="date text-error">21</h3>
                              <p class="month">May</p>
                            </div>
                            <div class="message_wrapper">
                              <h4 class="heading">Brian Michaels</h4>
                              <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                              <br>
                              <p class="url">
                                <span class="fs1" aria-hidden="true" data-icon=""></span>
                                <a href="#" data-original-title="">Download</a>
                              </p>
                            </div>
                          </li>
                          <li>
                            <img src="{{ URL::to('images/img.jpg') }}" class="avatar" alt="Avatar">
                            <div class="message_date">
                              <h3 class="date text-info">24</h3>
                              <p class="month">May</p>
                            </div>
                            <div class="message_wrapper">
                              <h4 class="heading">Desmond Davison</h4>
                              <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                              <br>
                              <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                              </p>
                            </div>
                          </li>
                        </ul>
                        <!-- end of user messages -->


                      </div>



              </div>

              <div class="col-md-6 col-xs-12">
                  @include('project.tasks')
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
                      </div>

                    </div>
                </div>
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
