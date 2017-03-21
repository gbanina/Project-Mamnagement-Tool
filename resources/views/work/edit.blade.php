
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>

            <div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Work <small>Admin</small></h2>
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
                {!! Form::model($work, array('route' => array('work.update', $work->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="work-name">Task <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('task_id', $tasks, $work->task_id, array('required'=> 'required', 'class' => 'form-control col-md-7 col-xs-12')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="work-name">Cost <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" step="any"  name="cost" value="{{$work->cost}}" required class="form-control"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
                            {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
                        </div>
                      </div>
                {!! Form::close() !!}
                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>

@endsection
