@extends('base')

@section('content')
       <div class="">
          <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => 'board', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit News <small>Dashboard</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Project</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_id', $projects, $board->project_id, array('required' => 'required', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Title</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::text('title', $board->title, array('required' => 'required', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Content</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::textarea('content', $board->content, ['rows'=> '12', 'class' => 'form-control']) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-7 col-sm-7 col-xs-7">
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-5">
                            {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                            <a href="{{ URL::to('board') }}" class="btn btn-primary" type="button">Cancel</a>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}
            </div>
        </div>
@endsection
