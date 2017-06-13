@extends('base')

@section('content')
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Settings</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{ URL::to('images/' . Auth::user()->avatar ) }}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{$user->name}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-envelope-o"></i> {{$user->email}}
                        </li>
                      </ul>

                      <a class="btn btn-success btn-sm"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>
                      {{ Form::open(array('url' => 'settings/'.$user->id, 'method' => 'delete', 'style'=>'display: inline')) }}
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-power-off m-right-xs"></i> Delete Account</button>
                      {{ Form::close() }}
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      @include('settings.accounts')
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/table/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::to('js/table/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
        <script>
          var table = $('#advanced-table').DataTable({

            });
        </script>
@endsection
