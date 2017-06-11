
@extends('base')

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12">
       <div class="">
            <div class="clearfix"></div>

            <div>
            <div class="row">
                <div class="x_panel">
                {!! Form::open(array('url' => TMBS::url('admin/role'), 'class' => 'form-horizontal form-label-left')) !!}
                  <div class="x_title">
                    <h2>Add New Role</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                      {!! Form::submit('Add', array('class' => 'btn btn-success')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('role-name', '', array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                      </div>
                    </div>
                    {!! Form::close() !!}
                </div>
              </div>
            </div>

          </div>
        </div>

@endsection
