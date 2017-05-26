@extends('base')

@section('content')

<div class="x_panel">
                  <div class="x_title">
                    <h2>All Users</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ URL::to('users/create') }}" class="btn btn-default" type="button">Invite User</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <table id="advanced-table" class="table table-striped projects">
                        <thead>
                          <tr>
                            <th><input id="id-filter" class="form-control"/></th>
                            <th><input id="name-filter" class="form-control"/></th>
                            <th><input id="email-filter" class="form-control"/></th>
                            <th>{!! WebComponents::userTypes() !!}</th>
                            <th>{!! WebComponents::roles() !!}</th>
                            <th><input id="date-filter" class="form-control"/></th>
                            <th></th>
                          </tr>
                          <tr>
                            <th style="width: 50px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th style="width: 85px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users as $usrAcc)
                          <tr>
                          <th scope="row"><a href="{{ URL::to('users/'.$usrAcc->id.'/edit') }}">{{$usrAcc->user->id}}</a></th>
                          <td><a href="{{ URL::to('users/'.$usrAcc->id.'/edit') }}">{{$usrAcc->user->name}}</a></td>
                          <td>{{$usrAcc->user->email}}</td>
                          <td>{{$usrAcc->type}}</td>
                          <td>{{$usrAcc->role->name}}</td>
                          <td>{{$usrAcc->user->created_at}}</td>
                            <td>
                              <li style="display: inline-block;">
                              <!--<a href="{{ URL::to('account/'.$usrAcc->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>-->
                              {{ Form::open(['route' => ['users.destroy', $usrAcc->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                              <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                              {{ Form::close() }}
                              </li>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

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
    var search_email = table.columns( table.colReorder.transpose( 2 ) ).search();
    $('#email-filter').val(search_email[0]);
    $('#email-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 2 ) ).search( this.value ).draw();
    });
    var search_type = table.columns( table.colReorder.transpose( 3 ) ).search();
    $('#type_id-filter').val(search_type[0]);
    $('#type_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 3 ) ).search( this.value ).draw();
    });
    var search_role = table.columns( table.colReorder.transpose( 4 ) ).search();
    $('#role_id-filter').val(search_role[0]);
    $('#role_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 4 ) ).search( this.value ).draw();
    });
    var search_date = table.columns( table.colReorder.transpose( 5 ) ).search();
    $('#date-filter').val(search_name[0]);
    $('#date-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 5 ) ).search( this.value ).draw();
    });
    </script>
@endsection
