
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 5%">#</th>
                          <th style="width: 35%">Name</th>
                          <th style="width: 5%">Status</th>
                          <th style="width: 5%">Type</th>
                          <th style="width: 20%">Edit</th>
                          <th style="width: 10%">Date</th>
                          <th style="width: 10%">Cost</th>
                          <th style="width: 5%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                          <td>{{$task->internal_id}}</td>
                          <td>
                            <a href="{{ URL::to('task/'.$task->id.'/edit') }}">
                              {{$task->name}}
                              <br>
                              <small>Created {{$task->created_at}}</small>
                            </a>
                          </td>
                          <td>
                            {{ $task->status }}
                          </td>
                          <td>
                            <button type="button" class="btn btn-default btn-xs">{{ $task->type }}</button>
                          </td>
                          <td>
                            <li style="display: inline-block;">
                            <a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a href="{{ URL::to('task-close/'.$task->id) }}" class="btn btn-success btn-xs"> Close </a>
                            @if($task->permission == 'DEL')
                                @component('component.delete-button', ['route' => 'task.destroy', 'id' => $task->id])
                                  Delete
                                @endcomponent
                            @endif
                            </li>
                          </td>
                          {!! Form::open(array('url' => 'work', 'class' => 'form-horizontal form-label-left')) !!}
                          <td>
                            <div class="xdisplay_inputx form-group">
                              {!! Form::text('date', '', array( 'class' => 'form-control datepicket_component')) !!}
                            </div>
                          {{ Form::hidden('task_id', $task->id) }}
                          </td>
                          <td>
                          <input type="number" step="any"  name="cost" value="0" required class="form-control"/>
                          </td>
                          <td>
                          {!! Form::submit('Add', array('class' => 'btn btn-default btn-xs')) !!}
                          </td>
                          {!! Form::close() !!}
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
