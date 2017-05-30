@extends('base')

@section('content')

{!! Form::open(array('url' => 'admin/status-reorder', 'class' => 'form-horizontal form-label-left')) !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
{!! Form::close() !!}
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Status</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ URL::to('/admin/status/create') }}" class="btn btn-default">Add new Status</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                      <table id="advanced-table" class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 25px"></th>
                            <th>Status Name</th>
                            <th style="width: 25px"></th>
                          </tr>
                         </thead>
                        <tbody>

                          @foreach ($statuses as $status)

                          <tr id="{{$status->id}}" datarow="{{$status->id}}">
                            <td class="draggable"><i class="fa fa-arrows"></i> </td>
                            <td>
                              <a href="{{ URL::to('admin/status/'.$status->id.'/edit') }}">{{$status->name}}</a>
                              <br>
                              <small>Created {{$status->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                                @component('component.delete-button', ['route' => 'status.destroy', 'id' => $status->id])
                                  Delete
                                @endcomponent
                              </li>
                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
@endsection

@section('js_include')
    <script src="{{ URL::to('js/table/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::to('js/table/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
        <script>
          var table = $('#advanced-table').DataTable({
              rowReorder: {
                selector: '.draggable',
              },
              //"bSort": false,
            });
          table.on( 'row-reorder', function ( e, diff, edit ) {
              for ( var i=0, ien=diff.length ; i<ien ; i++ ) {

                //koji id:
                var id = diff[i].node.attributes.datarow.nodeValue;
                var position = diff[i].newPosition;
                console.log('put ID:' + id + ' on ' + position + '.position')
                      $.ajax({
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          type: "POST", //PUT
                          url: "{{ URL::to('admin/status-reorder')}}", // ide na update metodu
                          data: {id: id, position: position},
                          success: function( msg ) {
                            // done
                          }
                      });
              }
          } );
        </script>
@endsection
