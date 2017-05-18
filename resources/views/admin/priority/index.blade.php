@extends('base')

@section('content')

{!! Form::open(array('url' => 'admin/priority-reorder', 'class' => 'form-horizontal form-label-left')) !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
{!! Form::close() !!}

<div class="col-md-6 col-sm-6 col-xs-12 form-group">
    <div class="x_panel">
                  <div class="x_title">
                    <h2>Priority <small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <a href="{{ URL::to('/admin/priority/create') }}" class="btn btn-default">Add new Priority</a>
                  <div class="x_content" style="display: block;">

                      <table id="advanced-table" class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 20%">Priority Name</th>
                            <th style="width: 20%">Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($priorities as $priority)
                          <tr id="{{$priority->id}}" datarow="{{$priority->id}}">
                            <td class="draggable">{{$priority->index}}</td>
                            <td class="draggable">
                              <a>{{$priority->label}}</a>
                              <br>
                              <small>Created {{$priority->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                              <a href="{{ URL::to('admin/priority/'.$priority->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                @component('component.delete-button', ['route' => 'priority.destroy', 'id' => $priority->id])
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
@endsection
@section('js_include')
    <script src="{{ URL::to('js/table/jquery.dataTables.min.js')}}"></script>

    <script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
        <script>
          var table = $('#advanced-table').DataTable({
              rowReorder: {
                selector: '.draggable'
              }
            });

          table.on( 'row-reorder', function ( e, diff, edit ) {
              for ( var i=0, ien=diff.length ; i<ien ; i++ ) {

                //koji id:
                var id = diff[i].node.attributes.datarow.nodeValue;
                var position = diff[i].newPosition;

                      $.ajax({
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          type: "POST", //PUT
                          url: "{{ URL::to('admin/priority-reorder')}}", // ide na update metodu
                          data: {id: id, position: position},
                          success: function( msg ) {
                            // done
                          }
                      });
              }
          } );
        </script>
@endsection
