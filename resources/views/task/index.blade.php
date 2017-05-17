@extends('base')

@section('content')
<div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tasks Overview</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="#" id="add_new_button" class="btn btn-default">Add new Task</a>
                      <!-- {{ Form::select('project_id', $projects, '', array('style' => 'max-width: 250px;','id'=>'project_id', 'class' => 'form-control', 'required')) }} -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="col-md-2 pull-left">

                  </div>
                  <div class="col-md-2 pull-left">

                  </div>
                  <div class="x_content" style="display: block;">
                    <table id="advanced-table"  class="table table-striped projects">
                      <thead>
                                              <tr>
                          <th style="max-width: 100px"><input id="id-filter" class="form-control"/></th>
                          <th><input id="name-filter" class="form-control"/></th>
                          <th><input id="members-filter" class="form-control"/></th>
                          <th><input id="project-filter" class="form-control"/></th>
                          <th>{!! WebComponents::taskTypeOverview() !!}</th>
                          <th>{!! WebComponents::statusOverview() !!}</th>
                          <th>{!! WebComponents::closedOverview() !!}</th>
                          <th>

<div class="dropdown dropup docs-options">
                        <button type="button" style="margin-bottom: 0px;" class="btn btn-default btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="false">
                          Toggle Columns
                          <span class="caret"></span>
                        </button>
                        <ul style="bottom: 0%" class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                          <li role="presentation">
                            <a class="toggle-vis" data-column="0">ID</a>
                          </li>
                          <li role="presentation">
                            <a class="toggle-vis" data-column="1">Task Name</a>
                          </li>
                          <li role="presentation">
                            <a class="toggle-vis" data-column="2">Team Members</a>
                          </li>
                          <li role="presentation">
                            <a class="toggle-vis" data-column="3">Project</a>
                          </li>

                          <li role="presentation">
                            <a class="toggle-vis" data-column="4">Type</a>
                          </li>
                          <li role="presentation">
                            <a class="toggle-vis" data-column="5">Status</a>
                          </li>
                          <li role="presentation">
                            <a class="toggle-vis" data-column="6">Closed</a>
                          </li>
                        </ul>
                      </div>

                          </th>
                        </tr>
                        <tr>
                          <th style="width: 30px;">#</th>
                          <th style="width: 20%">Task Name</th>
                          <th style="width: 12%">Team Members</th>
                          <th>Project</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th style="width: 5%">Closed</th>
                          <th style="width: 100px">Edit</th>
                        </tr>

                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                          <td>
                              <a href="{{ URL::to('task/'.$task->id.'/edit') }}">{{$task->internal_id}}</a>
                          </td>
                          <td class="overview-names">
                              <a title="{{$task->name}}" href="{{ URL::to('task/'.$task->id.'/edit') }}">{{$task->name}}</a>
                            <br>
                            <small>Created {{$task->created_at}}</small>
                          </td>
                          <td>
                            <ul class="list-inline">
                              @foreach($task->responsibleUsers as $user)
                              <li>
                                {{ $user->name }}
                              </li>
                              @endforeach
                            </ul>
                          </td>
                          <td class="project_progress">
                            <a href="{{ URL::to('project/'. $task->project_id . '/edit') }}">{{$task->project->name}}</a>
                          </td>
                          <td>
                            <button type="button" class="btn btn-default btn-xs">{{ $task->type }}</button>
                          </td>
                          <td>
                          {{ $task->status }}
                          </td>
                          <td>
                            {{ $task->close }}
                          </td>
                          <td>
                            <li style="display: inline-block;">
                              @if($task->close == 'Yes')
                              <a href="{{ URL::to('task-reopen/'.$task->id) }}" class="btn btn-primary btn-xs"> Reopen </a>
                              @else
                              <!--<a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>-->
                              <a href="{{ URL::to('task-close/'.$task->id) }}" class="btn btn-success btn-xs"> Close </a>
                              @endif
                              @if($task->permission == 'DEL')
                                @component('component.delete-button', ['route' => 'task.destroy', 'id' => $task->id])
                                  Delete
                                @endcomponent
                              @endif
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
          </div>

@endsection

@section('js_include')
    <script src="{{ URL::to('js/table/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::to('js/table/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.datatables.net/colreorder/1.3.3/js/dataTables.colReorder.min.js"></script>

    <script>
      $( "#project_id" ).change(function() {
        chainge_project_overview_add(this.value);
      });
      function chainge_project_overview_add(id){
        if(id != 0 && id != '0')
          $('#add_new_button').attr('href','{{ URL::to('task\/create') }}' + '?p=' + id);
      }
      $( document ).ready(function() {
          chainge_project_overview_add({{$firstProject}});
      });
    </script>
    <script>
      var table = $('#advanced-table').DataTable({
        stateSave: true,
        select: true,
        colReorder: true
    });
    var search_id = table.columns( table.colReorder.transpose( 0 ) ).search();
    $('#id-filter').val(search_id[0]);
    $('#id-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 0 ) ).search( this.value ).draw();
    });
    var search_name = table.columns( table.colReorder.transpose( 1 ) ).search();
    $('#name-filter').val(search_name[0]);
    $('#name-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 1 ) ).search( this.value ).draw();
    });
    var search_members = table.columns( table.colReorder.transpose( 2 ) ).search();
    $('#members-filter').val(search_members[0]);
    $('#members-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 2 ) ).search( this.value ).draw();
    });
    var search_projects = table.columns( table.colReorder.transpose( 3 ) ).search();
    $('#project-filter').val(search_projects[0]);
    $('#project-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 3 ) ).search( this.value ).draw();
    });
    var search_type = table.columns( table.colReorder.transpose( 4 ) ).search();
    $('#type_id-filter').val(search_type[0]);
    $('#type_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 4 ) ).search( this.value ).draw();
    });
    var search_status = table.columns( table.colReorder.transpose( 5 ) ).search();
    $('#status_id-filter').val(search_status[0]);
    $('#status_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 5 ) ).search( this.value ).draw();
    });
    var search_closed = table.columns( table.colReorder.transpose( 6 ) ).search();
    $('#closed-filter').val(search_closed[0]);
    $('#closed-filter').on( 'change', function () {
        table.columns( 6 ).search( this.value ).draw();
    });

    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
    </script>
@endsection
