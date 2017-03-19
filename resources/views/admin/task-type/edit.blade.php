
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
                  @if($errors->count() != 0):
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                {!! var_dump($errors->count()) !!}
                            </div>
                        </div>
                  @endif
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
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
                            {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
                        </div>
                      </div>

                    </div>
                </div>
              </div>
                <!-- Start to do list -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Add Additional Field For <strong>{{$taskType->name}}</strong></h2>
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
                    <div class="x_content">

                      <div class="">
                        <ul class="to_do">
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
                <!-- End to do list -->
                {!! Form::close() !!}
            </div>

          </div>
        </div>

@endsection
