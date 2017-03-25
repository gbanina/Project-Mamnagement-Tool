@extends('base')

@section('content')

<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Projects</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Projects</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    <a href="{{ URL::to('project/create') }}" class="btn btn-default">Add new Project</a>
                    <p>Listing all projects for {{Auth::user()->currentacc->name}}</p>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">ID</th>
                          <th >Project Name</th>
                          <th style="width: 20%">Responsible Users</th>
                          <th style="width: 20%">Project Progress</th>
                          <th style="width: 10%">Type</th>
                          <th style="width: 15%">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($projects as $project)
                          <tr>
                          <td>{{$project->internal_id}}</td>
                          <td>
                            <a href="{{ URL::to('project/'.$project->id.'/edit') }}">
                              {{$project->name}}
                              <br>
                              <small>Created {{$project->created_at}}</small>
                            </a>
                          </td>
                          <td>
                            <ul class="list-inline">
                            @foreach($project->responsibleUsers as $user)
                              <li>
                                <img src="{{ URL::to('images/' . $user->avatar) }}" class="avatar" alt="Avatar">
                              </li>
                              @endforeach
                            </ul>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57" aria-valuenow="57" style="width: 57%;"></div>
                            </div>
                            <small>57% Complete</small>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">{{$project->type}}</button>
                          </td>
                          <td>
                          <!--
                            <a href="{{ URL::to('project/'.$project->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            -->
                            <a href="{{ URL::to('project/'.$project->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>

                            @if($project->permission == 'DEL')
                                @component('component.delete-button', ['route' => 'project.destroy', 'id' => $project->id])
                                  Delete
                                @endcomponent
                            @endif
                          </td>
                        @endforeach
                        </tr>
                      </tbody>
                    </table>
                    <!-- end project list -->
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection
