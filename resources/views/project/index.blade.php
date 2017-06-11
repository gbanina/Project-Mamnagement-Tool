@extends('base')

@section('content')

<div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Projects Overview</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ TMBS::url('project/create') }}" class="btn btn-default">Add new Project</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    <!-- start project list -->
                    <table id="advanced-table" class="table table-striped projects">
                      <thead>
                      <tr>
                        <th><input id="id-filter" class="form-control"/></th>
                        <th><input id="name-filter" class="form-control"/></th>
                        <th><input id="manager-filter" class="form-control"/></th>
                        <th><input id="responsible-filter" class="form-control"/></th>
                        <th>{!! WebComponents::projectType() !!}</th>
                        <th></th>
                        <th></th>
                      </tr>
                        <tr>
                          <th style="min-width: 50px">ID</th>
                          <th style="min-width: 300px">Project Name</th>
                          <th style="min-width: 100px">Project Manager</th>
                          <th style="min-width: 130px">Default Responsible</th>
                          <th style="min-width: 100px">Type</th>
                          <th style="min-width: 100px">Project Progress</th>
                          <th style="min-width: 45px"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($projects as $project)
                          <tr>
                          <td>{{$project->internal_id}}</td>
                          <td class="overview-names">
                            <a title="{{$project->name}}" href="{{ TMBS::url('project/'.$project->id.'/edit') }}">
                              {{$project->name}}
                              <br>
                              <small>Created {{$project->created_at}}</small>
                            </a>
                          </td>
                          <td>
                              {{$project->ProjectManager}}
                          </td>
                           <td>
                              {{$project->ResponsibleUser}}
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">{{$project->type}}</button>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$project->progress}}" aria-valuenow="{{$project->progress}}"></div>
                            </div>
                            <small>{{$project->progress}}% Complete</small>
                          </td>
                          <td>

                            @if($project->permission == 'DEL')
                                @component('component.delete-button', ['url' => 'project', 'id' => $project->id])
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

@section('js_include')
    <script src="{{ URL::to('js/table/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::to('js/table/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.datatables.net/colreorder/1.3.3/js/dataTables.colReorder.min.js"></script>
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
    var search_manager = table.columns( table.colReorder.transpose( 2 ) ).search();
    $('#manager-filter').val(search_manager[0]);
    $('#manager-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 2 ) ).search( this.value ).draw();
    });
    var search_responsible = table.columns( table.colReorder.transpose( 3 ) ).search();
    $('#responsible-filter').val(search_responsible[0]);
    $('#responsible-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 3 ) ).search( this.value ).draw();
    });
    var search_type = table.columns( table.colReorder.transpose( 4 ) ).search();
    $('#type_id-filter').val(search_type[0]);
    $('#type_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 4 ) ).search( this.value ).draw();
    });
    </script>
@endsection
