@extends('base')

@section('content')
<div class="row">
  <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Plan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ TMBS::url('project-plan/create') }}" class="btn btn-default">Add new Project Plan</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th style="width: 100px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($plans as $plan)
                          <tr>
                            <td>
                              <a href="{{ TMBS::url('project-plan/'.$plan->id.'/edit') }}">{{$plan->name}}</a>
                              <br>
                              <small>Created {{$plan->created_at}}</small>
                            </td>
                            <td>{{$plan->type->label}}</td>
                            <td>
                              <li style="display: inline-block;">
                                @component('component.delete-button', ['url' => 'project-plan', 'id' => $plan->id])
                                  Delete
                                @endcomponent
                              </li>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
@endsection
