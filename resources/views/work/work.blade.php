{!! Form::text('week', '', array( 'class' => 'form-control has-feedback-left calendar-week')) !!}
                    <table style="width: 100%" class="table">
                      <thead>
                        <tr>
                          <th style="width: 50px">#</th>
                          <th>Task</th>
                          <th style="width: 115px">Date</th>
                          <th style="width: 75px">Time</th>
                          <th style="width: 115px"></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($works as $work)
                        @if($work->task != null)
                        <tr>
                          <td><a href="{{ TMBS::url('work/'.$work->id.'/edit') }}">{{$work->id}}</a></td>
                          <td class="overview-names"><a title="{{$work->task->name}}" href="{{ TMBS::url('work/'.$work->id.'/edit') }}">{{$work->task->name}}</a></td>
                          <td>{{$work->DateReal}}</td>
                          <td>{{$work->cost}}h</td>
                          <td>
                              <!--<a href="{{ URL::to('work/'.$work->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>-->
                                  @component('component.delete-button', ['url' => 'work', 'id' => $work->id])
                                    Delete
                                  @endcomponent
                          </td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
