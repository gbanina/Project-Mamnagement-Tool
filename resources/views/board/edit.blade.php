@extends('base')

@section('content')
       <div class="">
          <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => 'board', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit News <small>Dashboard</small></h2>
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
                  @if($errors->count() != 0):
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                {!! var_dump($errors->count()) !!}
                            </div>
                        </div>
                  @endif
                  <div class="x_content">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Project</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          {{ Form::select('project_id', $projects, $board->project_id, array('class' => 'form-control')) }}
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
