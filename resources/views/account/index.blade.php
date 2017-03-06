@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> My Accounts <small>{{Auth::user()->name}}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-xs-2">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        @foreach(Auth::user()->accounts as $acc)
                        <li @if($acc->id == Auth::user()->current_acc) class="active" @endif>
                            <a href="#{{$acc->id}}" data-toggle="tab">{{$acc->name}}</a>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="col-xs-10">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        @foreach(Auth::user()->accounts as $acc)
                        <div class="tab-pane @if($acc->id == Auth::user()->current_acc) active @endif" id="{{$acc->id}}">
                          <p class="lead">{{$acc->name}}</p>
                          <p>Name : {{$acc->name}}</p>
                          <p>Expires : {{$acc->expires}}</p>
                          <p>Licence : {{$acc->licence}}</p>
                          @include('account.users')
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
@endsection
