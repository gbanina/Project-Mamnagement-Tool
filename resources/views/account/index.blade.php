@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> My Accounts <small>{{Auth::user()->name}}</small></h2>
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
                          <ul class="stats-overview">
                            <li>
                              <span class="name"> Account Name </span>
                              <span class="value text-success"> {{$acc->name}}</span>
                            </li>
                            <li>
                              <span class="name"> Expires </span>
                              <span class="value text-success"> {{$acc->expires}} </span>
                            </li>
                            <li class="hidden-phone">
                              <span class="name"> Licence</span>
                              <span class="value text-success"> {{$acc->licence}} </span>
                            </li>
                          </ul>
                          <a href="{{ URL::to('/account/create?acc='.$acc->id) }}" class="btn btn-default">Add new user</a>
                          @include('account.users')
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
@endsection
