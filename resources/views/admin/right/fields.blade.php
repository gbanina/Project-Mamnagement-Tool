@foreach($project->projectType->posibleTaskTypes as $taskType)
    @if(count($taskType->fields) != 0)
<table class="table table-striped">
    <thead>
        <tr>
            <th style="border-bottom:none; border-top: none;"><a onClick="$('#hidden_{{$project->id}}_{{$role->id}}_{{$taskType->id}}').toggle()">{{$taskType->name}} <i class="fa fa-chevron-down"></i></a></th>
        </tr>
    </thead>
    <tbody id="hidden_{{$project->id}}_{{$role->id}}_{{$taskType->id}}" class="hidden-project-right-fields">
                          @foreach($taskType->fields as $field)
                          <tr>
                            <td style="width: 220px">{{$field->label}}</td>

                              @foreach($roles as $role)
                                <td>
                                @if(empty($field_rights[$project->id][$role->id][$taskType->id][$field->id]))
                                  <div class="btn-group right_{{$project->id}}_{{$role->id}}" data-toggle="buttons">
                                    <label class="btn btn-default active">
                                      <input type="radio" name="field_right[{{$project->id}}][{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="NONE" checked> 0
                                    </label>
                                    <label class="btn btn-default">
                                      <input type="radio" name="field_right[{{$project->id}}][{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="READ"> R
                                    </label>
                                    <label class="btn btn-default">
                                      <input type="radio" name="field_right[{{$project->id}}][{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="WRITE"> W
                                    </label>
                                  </div>
                                @else
                                  <div class="btn-group right_{{$project->id}}_{{$role->id}}" data-toggle="buttons">
                                    <label class="btn btn-default @if($field_rights[$project->id][$role->id][$taskType->id][$field->id] == 'NONE') active @endif">
                                      <input type="radio" name="field_right[{{$project->id}}][{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="NONE" @if($field_rights[$project->id][$role->id][$taskType->id][$field->id] == 'NONE') checked @endif> 0
                                    </label>
                                    <label class="btn btn-default @if($field_rights[$project->id][$role->id][$taskType->id][$field->id] == 'READ') active @endif" @if($field_rights[$project->id][$role->id][$taskType->id][$field->id] == 'READ') checked @endif>
                                      <input type="radio" name="field_right[{{$project->id}}][{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="READ"> R
                                    </label>
                                    <label class="btn btn-default @if($field_rights[$project->id][$role->id][$taskType->id][$field->id] == 'WRITE') active @endif" @if($field_rights[$project->id][$role->id][$taskType->id][$field->id] == 'WRITE') checked @endif>
                                      <input type="radio" name="field_right[{{$project->id}}][{{$role->id}}][{{$taskType->id}}][{{$field->id}}]" value="WRITE"> W
                                    </label>
                                  </div>
                                @endif
                                </td>
                              @endforeach <!-- role -->
                          </tr>
                          @endforeach <!-- field -->
    </tbody>
</table>
    @endif
@endforeach <!-- task type -->
