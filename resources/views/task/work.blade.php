<div class="x_panel">
                  <div class="x_title">
                    <h2>Logged hours for <strong>{{$task->name}}</strong> </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {!! Form::open(array('url' => TMBS::url('work'), 'class' => 'form-horizontal form-label-left')) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <table class="table">
                          <thead>
                            <tr>
                              <!--<th>Task</th>-->
                              <th>Date</th>
                              <th>Cost</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <!--<td>{{ Form::text('task_name', $task->name, array('disabled', 'class' => 'form-control')) }}</td>-->
                              <td>
                                {!! Form::text('date', '', array('id' => 'date',$global_css, 'class' => 'form-control has-feedback-left datepicket_component')) !!}
                              </td>
                              <td>
                                <input type="number" step="any" id="cost" name="cost" {{$global_css}} required class="form-control"/>
                                {{ Form::hidden('return_to', 'task/' . $task->id . '/edit') }}
                                {{ Form::hidden('task_id', $task->id, ['id' => 'task_id']) }}
                              </td>
                              <td>
                                @if($task->close == 'No')
                                  <a onClick="add_work()" class="btn btn-default" type="button">Add</a>
                                @endif
                              </td>
                            </tr>
                          </tbody>
                        </table>
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
                                    <td>{{$work->user->name}}</td>
                                    <td>{{$work->DateReal}}</td>
                                    <td>{{$work->cost}}h</td>
                                    <td>
                                        <a href="{{ TMBS::url('work/'.$work->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
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
