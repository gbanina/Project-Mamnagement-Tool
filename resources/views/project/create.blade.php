
@extends('base')

@section('content')
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                      {!! Form::open(array('url' => 'project', 'class' => 'form-horizontal form-label-left')) !!}
                  <div class="x_title">
                    <h2>Create New Project <small>Projects</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                          <a href="{{ URL::previous() }}" class="btn btn-default" type="button">Cancel</a>
                          {!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>

       <div class="">
            <div class="clearfix"></div>


            <div class="row">
                <div class="x_panel">
                  <div class="x_content">
                    <br>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {!! Form::text('project_name', '', array('required' => 'required', 'class' => 'form-control ','placeholder'=>'Project Name')) !!}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Manager</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        {{ Form::select('project_manager', $users, null, array('class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Type</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_type', $projectTypes, null, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Default Responsible</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            {{ Form::select('default_responsible', $users, null, array('class' => 'form-control', 'required')) }}
                        </div>
                      </div>
                  </div>
                </div>
            </div>
                    </div>
                    {!! Form::close() !!}
                </div>
              </div>
            </div>
        </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
