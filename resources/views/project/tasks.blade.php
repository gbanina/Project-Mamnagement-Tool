<div class="x_panel">
    <div class="x_title">
        <h2>Tasks</h2>
        <div class="clearfix"></div>
    </div>
                  <div class="x_content" style="display: block;">
                    <p>
                      <div id="task_type_buttons">
                        <a href="{{ URL::to('task/create') }}?p={{$project->id}}" class="btn btn-default" type="button">Add new Task</a>
                      </div>
                    </p>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 26%">Name</th>
                          <th style="width: 13%">Type</th>
                          <th style="width: 20%">Responsible</th>
                          <th style="width: 30%">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($project->tasks as $task)
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
                            <button type="button" class="btn btn-default btn-xs">{{ $task->type }}</button>
                          </td>
                          <td>
                            <ul class="list-inline">
                              @foreach($task->responsibleUsers as $user)
                              <li>
                                <img src="{{ URL::to('images/' . $user->avatar) }}" class="avatar" alt="Avatar">
                              </li>
                              @endforeach
                            </ul>
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
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
</div>
