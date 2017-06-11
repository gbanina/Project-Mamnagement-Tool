
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                 {!! Form::model($work, array('url' => TMBS::url('work/' . $work->id), 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
                  <div class="x_title">
                    <h2>Edit Work</h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                          {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                      </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="work-name">Task <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('task_id', $tasks, $work->task_id, array('required'=> 'required', 'class' => 'form-control col-md-7 col-xs-12')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="work-name">Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('date', $work->DateReal, array( 'class' => 'form-control has-feedback-left datepicket_component')) !!}
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="work-name">Cost <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" step="any"  name="cost" value="{{$work->cost}}" required class="form-control"/>
                        </div>
                      </div>

                    </div>
                    {!! Form::close() !!}
                </div>
              </div>
            </div>
        </div>

@endsection
@section('js_include')
  <script src="{{ URL::to('js/moment.min.js') }}"></script>
  <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
