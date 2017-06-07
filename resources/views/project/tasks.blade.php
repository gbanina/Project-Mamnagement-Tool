<div class="x_panel">
    <div class="x_title">
        <h2>Tasks</h2>
        <ul class="nav navbar-right panel_toolbox">
              <a href="{{ URL::to('task/create') }}?p={{$project->id}}" class="btn btn-default" type="button">Add new Task</a>
        </ul>
        <div class="clearfix"></div>
    </div>
                  <div class="x_content" style="display: block;">

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 50px">#</th>
                          <th >Name</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Responsible</th>
                          <th style="width: 100px">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($project->tasks as $task)
                        <tr>
                          <td>{{$task->internal_id}}</td>
                          <td class="overview-names">
                            <a title="{{$task->name}}" href="{{ URL::to('task/'.$task->id.'/edit') }}">
                              {{$task->name}}
                              <br>
                              <small>Created {{$task->created_at}}</small>
                            </a>
                          </td>
                          <td>
                            <button type="button" class="btn btn-default btn-xs">{{ $task->type }}</button>
                          </td>
                          <td>
                          {{ $task->status }}
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
                          <td>
                            <li style="display: inline-block;">
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
                    <!-- end project list -->

                  </div>
</div>
