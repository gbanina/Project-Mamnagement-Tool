
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>
            <div class="row">
            {!! Form::model($projectType, array('route' => array('project-type.update', $projectType->id), 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Project Task</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('type-name', $projectType->label, array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                      </div>
                    </div>
                </div>
              </div>
                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Active Task Types for <strong>{{$projectType->label}}</strong></h2>
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
                {!! Form::close() !!}
            </div>

          </div>
        </div>

@endsection
