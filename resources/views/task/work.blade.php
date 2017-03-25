<div class="x_panel">
                  <div class="x_title">
                    <h2>Logged hours for <strong>{{$task->name}}</strong> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {!! Form::open(array('url' => 'work', 'class' => 'form-horizontal form-label-left')) !!}
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Task</th>
                              <th>Date</th>
                              <th>Cost</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>

                              <td>{{ Form::text('task_name', $task->name, array('disabled', 'class' => 'form-control')) }}</td>
                              <td>
                                {!! Form::text('date', '', array('class' => 'form-control has-feedback-left datepicket_component')) !!}
                              </td>
                              <td>
                                <input type="number" step="any"  name="cost" required class="form-control"/>
                                {{ Form::hidden('return_to', 'task/' . $task->id . '/edit') }}
                                {{ Form::hidden('task_id', $task->id) }}
                              </td>
                              <td>{!! Form::submit('Add', array('class' => 'btn btn-success')) !!}</td>
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
                                <tbody>
                                @foreach ($task->work as $work)
                                  <tr>
                                    <td>{{$work->user->name}}</td>
                                    <td>{{$work->DateReal}}</td>
                                    <td>{{$work->cost}}h</td>
                                    <td>
                                        <a href="{{ URL::to('work/'.$work->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            @component('component.delete-button', ['route' => 'work.destroy', 'id' => $work->id])
                                              Delete
                                            @endcomponent
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>

                  </div>
                </div>
