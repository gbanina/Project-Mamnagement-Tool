@extends('base')

@section('content')
       <div class="">
          <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => 'board', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add News <small>Dashboard</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                        {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Project</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_id', $projects, '', array('required' => 'required', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Title</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::text('title', '', array('required' => 'required', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Content</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::textarea('content', '', ['rows'=> '12', 'class' => 'form-control']) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-7 col-sm-7 col-xs-7">
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
        </div>
@endsection
