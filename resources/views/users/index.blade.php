@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2>All Users <small>organisation</small></h2>
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

                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th>Team</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($users as $user)
                        <tr>
                          <th scope="row">{{$user->id}}</th>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->created_at}}</td>
                          <td>dummy</td>
                          <td>edit icon</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
@endsection
