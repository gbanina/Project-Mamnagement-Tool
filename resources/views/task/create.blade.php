@extends('base')

@section('content')
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
{!! Form::open(array('url' => 'task', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="x_title">
                  <div class="header-buttons">
                  <h2>Add New Task to <strong>{{$projectName}}</strong>
                      {{ Form::select('type_id', $types, $typeId, array('id' => 'type_id', 'style' => 'display:inline;width: 200px;','class' => 'form-control')) }}
                  </h2>
                  <ul class="nav navbar-right panel_toolbox">
                       <a href="#" onclick="goBack()" class="btn btn-default" type="button">Cancel</a>
                       {!! Form::submit('Submit', array($global_css, 'class' => 'btn btn-success')) !!}
                  </ul>
                  </div>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                {{ Form::hidden('project_id', $projectId) }}
                  <div class="x_content usable-fields">
                    @foreach($fields as $rowId => $row)
                      <div id="row_{{$rowId}}" class="view view-first">
                        <div id="cols_{{$rowId}}">
                          @foreach($row as $colId => $col)
                            <div id="col_{{$colId}}_{{$rowId}}" class="col-md-{{(12 / count($row))}} col-sm-12 col-xs-12 form-group">
                                @foreach($col as $field)
                                  @if($field['field']->type != 'COMMENTS' && $field['field']->type != 'WORK')
                                      <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">{{$field['field']->label}}</label>
                                        <div class="col-md-8 col-sm-8 col-xs-12 possibly-hide">
                                          @component('component.additional-field', [
                                                                                    'field' => $field,
                                                                                    'id' => $field['field']->id,
                                                                                    'global_css' => '',
                                                                                    'users' => $users,
                                                                                    'usersO' => $usersO,
                                                                                    'status' => $status,
                                                                                    'priorities' => $priorities,
                                                                                    'types' => $types])
                                          @endcomponent
                                        </div>
                                      </div>
                                  @endif
                                @endforeach
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endforeach
                  </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>

            </div>
        </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
    <script>

    $( document ).ready(function() {
        $( "#type_id" ).change(function() {
          window.location.href = "{{ URL::to('task/create?p='.$projectId) }}\&type_id=" + $( "#type_id" ).val();
        });
    });
    </script>
@endsection
