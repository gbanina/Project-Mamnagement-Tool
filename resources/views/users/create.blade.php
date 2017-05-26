
@extends('base')

@section('content')

       <div class="">
            <div class="clearfix"></div>

            <div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                {!! Form::open(array('url' => 'users', 'class' => 'form-horizontal form-label-left')) !!}
                  <div class="x_title">
                    <h2>Invite User to {{Auth::user()->currentacc->name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                        {!! Form::submit('Invite', array('class' => 'btn btn-success')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{ Form::text('name', '', array('required' => 'required', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{ Form::email('email', '', array('required' => 'required', 'class' => 'form-control')) }}
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{ Form::select('role_id', $roles, '', array('required' => 'required', 'class' => 'form-control')) }}
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
