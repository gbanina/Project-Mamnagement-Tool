<div class="x_panel">
                  <div class="x_title">
                    <h2>Logged hours for <strong>{{$task->name}}</strong> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        @if($task->close == 'No')
                            <a data-toggle="modal" data-target=".bs-example-modal-sm-{{$task->id}}" class="btn btn-default" type="button">Add</a>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {!! Form::open(array('url' => TMBS::url('work'), 'class' => 'form-horizontal form-label-left')) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    {!! Form::close() !!}
                             <table class="table">
                                <thead>
                                  <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="work_costs">
                                @foreach ($task->work as $work)
                                  <tr>
                                    <td>
                                      <a onClick="alert('Not implemented yet!')" ><i class="fa fa-clock-o"></i></a>
                                      {{$work->user->name}}
                                    </td>
                                    <td>{{$work->updated_at}}</td>
                                    <td>{{$work->time}}h</td>
                                    <td>
                                            @component('component.delete-button', ['url' => 'work', 'id' => $work->id])
                                              Delete
                                            @endcomponent
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>

                  </div>
                </div>
<script>
function add_work()
{
      $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST", //PUT
            url: "{{ TMBS::url('work-save')}}", // ide na update metodu
            data: {date: $("#date").val(), task_id: $("#task_id").val(), cost: $("#cost").val()},
            success: function( msg ) {
              new PNotify({
                  title: 'Success',
                  text: 'Your work has been saved successfully!',
                  type: 'alert-success',
                  styling: 'bootstrap3'
              });
              $content = work_append_content(msg);
              $( "#work_costs" ).append( $content );
            }

        });
}
function work_append_content(id)
{
  var result = '';
  result += '      <tr>';
  result += '         <td>{{Auth::user()->name}}</td>';
  result += '         <td>'+$('#date').val()+'</td>';
  result += '         <td>'+$('#cost').val()+'</td>';
  result += '         <td><a href="{{ TMBS::url('work') }}/'+id+'/edit" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><button type="submit" class="btn btn-danger btn-xs">Delete</button></td>';
  result += '      <tr>';
  return result;
}
</script>
