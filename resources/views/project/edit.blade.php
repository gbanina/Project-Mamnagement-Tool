@extends('base')

@section('content')
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                    <ul class="stats-overview">
                          <li>
                            <span class="name"> Project ID </span>
                            <span class="value text-success"> {{$project->internal_id}} </span>
                          </li>
                          <li>
                            <span class="name"> Estimated Start Date </span>
                            <span class="value text-success"> {{$project->estimatedStartDate}} </span>
                          </li>
                          <li>
                            <span class="name"> Estimated End Date </span>
                            <span class="value text-success"> {{$project->estimatedEndDate}} </span>
                          </li>
                          <li class="hidden-phone">
                            <span class="name"> Estimated cost</span>
                            <span class="value text-success"> {{$project->estimatedCost}} </span>
                          </li>
                          <li>
                            <span class="name"> Real Start Date </span>
                            <span class="value text-success"> {{$project->realStartDate}} </span>
                          </li>
                          <li>
                            <span class="name"> Real End Date </span>
                            <span class="value text-success"> {{$project->realEndDate}} </span>
                          </li>
                          <li class="hidden-phone">
                            <span class="name"> Real cost</span>
                            <span class="value text-success"> {{$project->realCost}} </span>
                          </li>
                        </ul>
              </div>
              <div class="col-md-6 col-sm-12 col-xs-12">
                      {!! Form::model($project, array('url' => TMBS::acc() . '/project/' . $project->id, 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
                                      <div class="x_panel">
                                        <div class="x_title">
                                          <h2>Project : <strong>{{$project->type}}</strong></h2>
                                          <ul class="nav navbar-right panel_toolbox">
                                              <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                                               {!! Form::submit('Save', array($global_css, 'class' => 'btn btn-primary')) !!}
                                          </ul>
                                          <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                          <br>

                                          <div class="form-group">
                                              <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Name</label>
                                              <div class="col-md-8 col-sm-8 col-xs-12">
                                                {!! Form::text('project_name', $project->name, array($global_css, 'required' => 'required', 'class' => 'form-control ','placeholder'=>'Project Name')) !!}
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <label class="control-label col-md-4 col-sm-4 col-xs-12">Project Manager</label>
                                              <div class="col-md-8 col-sm-8 col-xs-12">
                                              {{ Form::select('project_manager', $users, $project_manager, array($global_css, 'class' => 'form-control')) }}
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-md-4 col-sm-4 col-xs-12">Default Responsible</label>
                                              <div class="col-md-8 col-sm-8 col-xs-12">
                                                  {{ Form::select('default_responsible', $users, $project->default_responsible, array($global_css, 'class' => 'form-control', 'required')) }}
                                              </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                              <div class="btn-group">
                                                <a href="{{ TMBS::url('project-rights/'.$project->id) }}" class="btn btn-default" type="button">Permissions</a>
                                                <button class="btn btn-default" type="button">Versions</button>
                                                <button class="btn btn-default" type="button">Components</button>
                                              </div>
                                        </div>
                                      </div>
                      {!! Form::close() !!}

                        @include('project.tasks')
              </div>

              <div class="col-md-6 col-xs-12">
                  @component('component.comments', ['id' => $project->id, 'type' => 'PROJECT', 'comments' => $comments, 'global_css' => ''])
                  @endcomponent
              </div>
            </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
