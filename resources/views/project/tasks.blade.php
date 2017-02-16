                  <div class="x_content" style="display: block;">
                    <p>Task listings for the project : {{$project->name}}</p>
                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Task Name</th>
                          <th>Team Members</th>
                          <th style="width: 20%">Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($project->tasks as $task)
                        <tr>
                          <td>{{$task->id}}</td>
                          <td>
                            <a>{{$task->name}}</a>
                            <br>
                            <small>Created {{$task->created_at}}</small>
                          </td>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="../../images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="../../images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="../../images/user.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="../../images/user.png" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td>
                            <li style="display: inline-block;">
                            <a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="{{ URL::to('task/'.$task->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            {{ Form::open(['route' => ['task.destroy', $task->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                            {{ Form::close() }}
                            <li>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
