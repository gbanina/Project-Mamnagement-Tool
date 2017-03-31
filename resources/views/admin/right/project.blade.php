<div class="x_panel" style="height: auto;">
      <div class="x_title">
              <table class="table table-striped">
                        <thead>
                          <tr>
                              <th style="width: 220px">
                                <h5 style=" white-space: nowrap;">
                                  <a class="collapse-link">{{$project->name}}
                                  <i class="fa fa-chevron-up"></i></a>
                                </h5>

                              </th>
                            @foreach($roles as $role)
                              <th>{{$role->name}} <a href="{{ URL::to('morph/' . $role->id) }}"><i class="fa fa-eye"></i></a></th>
                            @endforeach
                          </tr>
                           <tr>
                              <th></th>
                            @foreach($roles as $role)
                              <th>
                                @if(empty($field_rights[$project->id]))
                                <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default active" onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','NONE')">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="NONE" checked id="{{$project->id}}_{{$role->id}}_1"> 0
                                  </label>
                                  <label class="btn btn-default" onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','READ')">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="READ" id="{{$project->id}}_{{$role->id}}_2"> R
                                  </label>
                                  <label class="btn btn-default" onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','WRITE')">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="WRITE" id="{{$project->id}}_{{$role->id}}_3"> W
                                  </label>
                                  <label class="btn btn-default" onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','WRITE')">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="DEL" id="{{$project->id}}_{{$role->id}}_4"> D
                                  </label>
                                </div>
                                @else
                                <div class="btn-group" data-toggle="buttons">
                                  <label onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','NONE')" class="btn btn-default @if($project_rights[$project->id][$role->id] == 'NONE') active @endif">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="NONE" id="{{$project->id}}_{{$role->id}}_2" @if($project_rights[$project->id][$role->id] == 'NONE') checked @endif> 0
                                  </label>
                                  <label onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','READ')" class="btn btn-default @if($project_rights[$project->id][$role->id] == 'READ') active @endif">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="READ" id="{{$project->id}}_{{$role->id}}_3" @if($project_rights[$project->id][$role->id] == 'READ') checked @endif> R
                                  </label>
                                  <label onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','WRITE')" class="btn btn-default @if($project_rights[$project->id][$role->id] == 'WRITE') active @endif">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="WRITE" id="{{$project->id}}_{{$role->id}}_4" @if($project_rights[$project->id][$role->id] == 'WRITE') checked @endif> W
                                  </label>
                                  <label onclick="chaingeChildRight('right_{{$project->id}}_{{$role->id}}','WRITE')" class="btn btn-default @if($project_rights[$project->id][$role->id] == 'DEL') active @endif">
                                    <input type="radio" name="project_right[{{$project->id}}][{{$role->id}}]" value="DEL" id="{{$project->id}}_{{$role->id}}_5" @if($project_rights[$project->id][$role->id] == 'DEL') checked @endif> D
                                  </label>
                                </div>
                                @endif
                              </th>
                            @endforeach
                          </tr>
                        </thead>
                        </table>
                </div> <!-- <div class="x_title"> -->
                <div class="x_content" style="display: block;">
                    @include('admin.right.fields')
                </div>
              </div>
