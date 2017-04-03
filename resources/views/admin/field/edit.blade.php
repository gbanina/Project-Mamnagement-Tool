
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>
            <div>
            <div class="row">
            {!! Form::model($field, array('route' => array('field.update', $field->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Edit Additional Field<small>Admin</small></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type-name">Name <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('field-name', $field->label, array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-type-name">Type <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('field-type', $typeSelect, $field->type, array('class' => 'form-control')) }}
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
                      <h2>Add This Additional Field to Task Types</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="to_do">
                        @foreach($taskTypes as $type)
                          <li>
                            <p>
                              {{ Form::checkbox('task_type['.$type->id.']' , $type->id, in_array ($type->id, $belongsToTaskType), ['class' => 'flat']) }} {{$type->name}}
                              </p>
                          </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
            {!! Form::close() !!}
              </div>
            </div>
          </div>
@endsection
