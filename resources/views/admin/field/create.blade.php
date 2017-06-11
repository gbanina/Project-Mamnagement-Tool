
@extends('base')

@section('content')

      <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => TMBS::url('admin/field'), 'class' => 'form-horizontal form-label-left')) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Add New Available Field</h2>
                      <ul class="nav navbar-right panel_toolbox">
                          <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                         {!! Form::submit('Add', array('class' => 'btn btn-success')) !!}
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <br>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-type-name">Label <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('field-name', '', array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-type-name">Type <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('field-type', $typeSelect, null, array('class' => 'form-control')) }}
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                {!! Form::close() !!}
              </div>


@endsection
