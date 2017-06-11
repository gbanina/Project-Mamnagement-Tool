@extends('base')
@section('content')
       <div class="">
          <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                {!! Form::model($account, array('url' => TMBS::url('users/' . $account->id), 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
                  <div class="x_title">
                    <h2>Edit User</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                        {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status-name">Name <span class="required">*</span>
                        </label>
                        <label style="text-align: left;" class="control-label col-md-6 col-sm-6 col-xs-12">
                          {{$account->user->name}}
                        </label>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status-name">Type <span class="required">*</span>
                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        @if($account->type == 'OWNER' )
                          <label style="text-align: left;" class="control-label col-md-9 col-sm-9 col-xs-12">
                            Owner <small>(*you cannot downgrade account owner)</small>
                            {{ Form::hidden('type', 'OWNER') }}
                          </label>
                        @else
                        {{ Form::select('type', $types, $account->type, array('class' => 'form-control')) }}
                        @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status-name">Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {{ Form::select('role_id', $roles, $account->role_id, array('class' => 'form-control')) }}
                        </div>
                      </div>
                    </div>
                    {!! Form::close() !!}
                </div>
              </div>
            </div>
        </div>

@endsection
