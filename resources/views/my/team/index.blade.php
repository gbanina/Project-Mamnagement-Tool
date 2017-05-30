@extends('base')

@section('content')
<div class="row">

      <div class="x_panel">
                  <div class="x_title">
                    <h2>My Team</h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="x_content">

<div class="col-md-12 col-sm-12 col-xs-12 text-center">
                      </div>
                      <div class="clearfix"></div>

                    @foreach($team as $account)

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>{{$account->role->name}}</i></h4>
                            <div class="left col-xs-7">
                              <h2>{{$account->user->name}}</h2>
                              <p><strong>About: </strong> Web Designer / UI. </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                                <li><i class="fa fa-envelope-o"></i> Email : {{$account->user->email}}</li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{ URL::to('images/' . $account->user->avatar ) }}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <p class="ratings">
                                <a>4.0</a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star"></span></a>
                                <a href="#"><span class="fa fa-star-o"></span></a>
                              </p>
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                </i> <i class="fa fa-comments-o"></i> </button>
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>

                    @endforeach

                    </div>
                  </div>
              </div>
@endsection
