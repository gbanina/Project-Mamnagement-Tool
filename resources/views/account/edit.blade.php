
@extends('base')

@section('content')

       <div class="">
            <div class="clearfix"></div>

            <div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Account <small>Accounts</small></h2>
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
                {!! Form::model($account, array('route' => array('account.update', $account->id), 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
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
