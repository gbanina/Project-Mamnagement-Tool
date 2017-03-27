
@extends('base')

@section('content')
    <div class="">
        <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => 'admin/project-type', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Project Type <small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="project-type-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('type-name', '', array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
                            {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
                        </div>
                      </div>
                    </div>
                </div>
              </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Add Task Types for current project type</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="to_do">
                        @foreach($taskTypes as $type)
                          <li>
                            <p>
                              {{ Form::checkbox('task_type['.$type->id.']' , $type->id, in_array ($type->id, $hasTaskType), ['class' => 'flat']) }} {{$type->name}}
                              </p>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
@endsection
