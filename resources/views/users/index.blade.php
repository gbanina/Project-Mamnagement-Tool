@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2>All Users <small>{{Auth::user()->currentacc->name}}</small></h2>
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
                          <th scope="row">{{$user->user->id}}</th>
                          <td>{{$user->user->name}}</td>
                          <td>{{$user->user->email}}</td>
                          <td>{{$user->user->created_at}}</td>
                          <td>dummy</td>
                          <td>edit icon</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
@endsection
