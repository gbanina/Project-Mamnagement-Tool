
@extends('base')

@section('content')

       <div class="">
            <div class="clearfix"></div>

            <div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invite user to {{Auth::user()->currentacc->name}}<small>Accounts</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                {!! Form::open(array('url' => 'account/create', 'class' => 'form-horizontal form-label-left')) !!}
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{ Form::email('email', '', array('class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
                            {!! Form::submit('Invite', array('class' => 'btn btn-default')) !!}
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
