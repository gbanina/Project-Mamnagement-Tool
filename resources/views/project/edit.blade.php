
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
                        {{ Form::select('project_manager', $users, '', array('disabled', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_type', $projectTypes, $project->project_types_id, array('class' => 'form-control', 'required')) }}
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
                          Task, Issue, Bug, Epic, Idea <br>
                            <a href="" style="margin-bottom: 5px" class="btn btn-primary btn-xs">Edit</a>
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
                            <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Estimated Start Date" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status1" class="sr-only">(success)</span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess_status" class="sr-only">(success)</span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control has-feedback-left" id="single_cal4" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Cost</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="number" class="form-control" placeholder="Estimated Cost">
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Real Cost</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="number" class="form-control" placeholder="Real Cost">
                        </div>
                      </div>
                  </div>
                </div>
              </div>

            </div>


            <!-- end design1 -->



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
              </div>
            </div>
        </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
