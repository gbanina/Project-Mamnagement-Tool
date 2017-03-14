@extends('base')

@section('content')

<div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$project->name}} <small><a href="{{ URL::to('project') }}">Projects</a> > Project Rights</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    {!! Form::open(array('url' => 'project-rights/' . $project->id)) !!}
                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

                      <table class="table table-striped">
                        <thead>
                          <tr>
                              <th style="width: 15%;"></th>
                            @foreach($roles as $role)
                              <th>{{$role->name}}</th>
                            @endforeach
                          </tr>
                           <tr>
                              <th style="width: 15%;"></th>
                            @foreach($roles as $role)
                              <th>
                                @if(empty($field_rights))
                                <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default active">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="NONE" id="{{$project->id}}_{{$role->id}}_1"> 0
                                  </label>
                                  <label class="btn btn-default">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="READ" id="{{$project->id}}_{{$role->id}}_1"> R
                                  </label>
                                  <label class="btn btn-default">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="WRITE" id="{{$project->id}}_{{$role->id}}_1"> W
                                  </label>
                                  <label class="btn btn-default">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="DEL" id="{{$project->id}}_{{$role->id}}_1"> D
                                  </label>
                                </div>
                                @else
                                <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default @if($project_rights[$role->id] == 'NONE') active @endif">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="NONE" id="{{$project->id}}_{{$role->id}}_1"> 0
                                  </label>
                                  <label class="btn btn-default @if($project_rights[$role->id] == 'READ') active @endif">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="READ" id="{{$project->id}}_{{$role->id}}_1"> R
                                  </label>
                                  <label class="btn btn-default @if($project_rights[$role->id] == 'WRITE') active @endif">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="WRITE" id="{{$project->id}}_{{$role->id}}_1"> W
                                  </label>
                                  <label class="btn btn-default @if($project_rights[$role->id] == 'DEL') active @endif">
                                    <input type="radio" name="project_right[{{$role->id}}]" value="DEL" id="{{$project->id}}_{{$role->id}}_1"> D
                                  </label>
                                </div>

                                @endif
                              </th>
                            @endforeach
                          </tr>
                        </thead>
                      @foreach($project->projectType->posibleTaskTypes as $taskType)
                        <thead>
                          <tr>
                            <th style="border-bottom:none; border-top: none;">{{$taskType->name}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tbody>
                          @foreach($taskType->fields as $field)
                          <tr>
                            <td>{{$field->label}}</td>

                              @foreach($roles as $role)
                                <td>
                                @if(empty($field_rights))
                                  <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                      <input type="radio" name="field_right[{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="NONE"> 0
                                    </label>
                                    <label class="btn btn-default">
                                      <input type="radio" name="field_right[{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="READ"> R
                                    </label>
                                    <label class="btn btn-default">
                                      <input type="radio" name="field_right[{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="WRITE"> W
                                    </label>
                                  </div>
                                @else
                                  <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default @if($field_rights[$role->id][$taskType->id][$field->id] == 'NONE') active @endif">
                                      <input type="radio" name="field_right[{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="NONE"> 0
                                    </label>
                                    <label class="btn btn-default @if($field_rights[$role->id][$taskType->id][$field->id] == 'READ') active @endif">
                                      <input type="radio" name="field_right[{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="READ"> R
                                    </label>
                                    <label class="btn btn-default @if($field_rights[$role->id][$taskType->id][$field->id] == 'WRITE') active @endif">
                                      <input type="radio" name="field_right[{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="WRITE"> W
                                    </label>
                                  </div>
                                @endif
                                </td>
                              @endforeach <!-- role -->
                          </tr>
                          @endforeach <!-- field -->
                        </tbody>
                        @endforeach <!-- taskType -->
                      </table>
                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script>
            $(".active").click();
          </script>
@endsection
