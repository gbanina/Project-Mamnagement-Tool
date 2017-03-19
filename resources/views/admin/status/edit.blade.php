
@extends('base')

@section('content')
<div class="col-md-6 col-sm-6 col-xs-12">
       <div class="">
            <div class="clearfix"></div>
            <div>
            <div class="row">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Status <small>Admin</small></h2>
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
                {!! Form::model($status, array('route' => array('status.update', $status->id), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('status-name', $status->name, array('required' => 'required', 'class' => 'form-control col-md-7 col-xs-12')) !!}
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
