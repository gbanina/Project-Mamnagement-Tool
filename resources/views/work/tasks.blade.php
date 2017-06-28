
                    <table id="advanced-table" style="width:100%" class="table table-striped projects">
                      <thead>
                        <tr>
                          <th><input id="id-filter" class="form-control"/></th>
                          <th><input id="name-filter" class="form-control"/></th>
                          <th><input id="project-filter" class="form-control"/></th>
                          <th>{!! WebComponents::statusOverview() !!}</th>
                          <th>{!! WebComponents::taskTypeOverview() !!}</th>
                          <th></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th style="width: 35px">#</th>
                          <th>Name</th>
                          <th>Project</th>
                          <th style="width: 125px">Status</th>
                          <th style="width: 125px">Type</th>
                          <th style="width: 100px">Time</th>
                          <th style="width: 120px">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                          <td><a href="{{ TMBS::url('task/'.$task->id.'/edit') }}">{{$task->internal_id}}</a></td>
                          <td class="overview-names">
                            <a title="{{$task->name}}" href="{{ TMBS::url('task/'.$task->id.'/edit') }}">
                              {{$task->name}}
                              <br>
                              <small>Created {{$task->created_at}}</small>
                            </a>
                          </td>
                          <td class="overview-names">
                            {{$task->project->name}}
                          </td>
                          <td>
                            {{ $task->status }}
                          </td>
                          <td>
                            <button type="button" class="btn btn-default btn-xs">{{ $task->type }}</button>
                          </td>
                          <td style="font-size: 16px;">
                          <a data-toggle="modal" data-target=".bs-example-modal-sm-{{$task->id}}"><i class="fa fa-clock-o"></i></a>
                          @component('component.time.add', ['task' => $task])
                          @endcomponent
                           @if($working_on != $task->id)
                            {{$task->times}}
                            <a href="{{ TMBS::url('workingon/start/'.$task->id) }}" >
                              <i class="fa fa-play"></i>
                            </a>
                            @else
                              <span class="tmb-count-active-task"></span>
                            <script>
                              $( document ).ready(function() {
                                  tmbsUpdateTaskClock("{{$start_time}}", "{{$task->times}}");
                                  setInterval('tmbsUpdateTaskClock("{{$start_time}}", "{{$task->times}}")', 1000 );
                              });
                            </script>
                            <a href="{{ TMBS::url('workingon/end/'.$task->id) }}" >
                              <i class="fa fa-stop"></i>
                            </a>
                            @endif
                          </td>
                          <td>
                            <li style="display: inline-block;">

                            <!--<a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>-->
                            <a href="{{ TMBS::url('task-close/'.$task->id) }}" class="btn btn-success btn-xs"> Close </a>
                            @if($task->permission == 'DEL')
                                @component('component.delete-button', ['url' => 'task', 'id' => $task->id])
                                  Delete
                                @endcomponent
                            @endif
                            </li>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
