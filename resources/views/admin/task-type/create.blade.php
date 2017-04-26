
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => 'admin/task-type', 'class' => 'form-horizontal form-label-left')) !!}

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Task Type <small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-type-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('type-name', '', array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-type-name">View <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('type_id', $taskViews, '', array('class' => 'form-control', 'required')) }}
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
                      <h2>Add Additional Field For Current Task Type</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
                        @foreach($taskFields as $field)
                          <li>
                            <p>
                              {{ Form::checkbox('task_field['.$field->id.']' , $field->id, in_array ($field->id, $hasTaskField), ['class' => 'flat']) }} {{$field->label}}
                              </p>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>This task type belongs to project types :</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
                        @foreach($projectTypes as $type)
                          <li>
                            <p>
                              {{ Form::checkbox('project_type['.$type->id.']' , $type->id, in_array ($type->id, $hasProjectType), ['class' => 'flat']) }} {{$type->label}}
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
