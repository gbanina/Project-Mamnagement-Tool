
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>
            <div>
            <div class="row">
            {!! Form::model($taskType, array('route' => array('task-type.update', $taskType->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Task Type<small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('type-name', $taskType->name, array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-type-name">View <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('type-view', $taskViews, $taskType->parent, array('class' => 'form-control', 'required')) }}
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
                      <h2><strong>{{$taskType->name}}</strong> belongs to project types :</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
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
        </div>

@endsection
