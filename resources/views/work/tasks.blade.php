
                    <table id="advanced-table" style="width:100%" class="table table-striped projects">
                      <thead>
                        <tr>
                          <th><input id="id-filter" class="form-control"/></th>
                          <th><input id="name-filter" class="form-control"/></th>
                          <th>{!! WebComponents::statusOverview() !!}</th>
                          <th>{!! WebComponents::taskTypeOverview() !!}</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th style="width: 35px">#</th>
                          <th>Name</th>
                          <th style="width: 125px">Status</th>
                          <th style="width: 125px">Type</th>
                          <th style="width: 100px">Date</th>
                          <th style="width: 10%">Cost</th>
                          <th style="width: 5%">Add</th>
                          <th style="width: 120px">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                          <td><a href="{{ URL::to('task/'.$task->id.'/edit') }}">{{$task->internal_id}}</a></td>
                          <td class="overview-names">
                            <a title="{{$task->name}}" href="{{ URL::to('task/'.$task->id.'/edit') }}">
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
                          <td>
                            <li style="display: inline-block;">
                            <!--<a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>-->
                            <a href="{{ URL::to('task-close/'.$task->id) }}" class="btn btn-success btn-xs"> Close </a>
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
