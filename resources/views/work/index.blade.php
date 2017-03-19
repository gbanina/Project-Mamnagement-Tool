@extends('base')

@section('content')
<div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My work for this week <small>41h</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    {!! Form::open(array('url' => 'work', 'class' => 'form-horizontal form-label-left')) !!}
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Task</th>
                              <th>Cost</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>

                              <td>{{ Form::select('task_id', $tasks, '', array('required'=> 'required', 'class' => 'form-control')) }}</td>
                              <td>
                                <input type="number" step="any"  name="cost" required class="form-control"/>
                                {{ Form::hidden('return_to', 'work') }}
                              </td>
                              <td>{!! Form::submit('Add', array('class' => 'btn btn-success')) !!}</td>
                            </tr>
                          </tbody>
                        </table>
                    {!! Form::close() !!}
                    @component('component.alert')
                    @endcomponent
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Task</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($works as $work)
                        <tr>
                          <th scope="row">#</th>
                          <td><a href="{{ URL::to('task/'.$work->task->id.'/edit') }}">{{$work->task->name}}</a></td>
                          <td>{{$work->created_at}}</td>
                          <td>{{$work->cost}}h</td>
                          <td>
                              {{ Form::open(['route' => ['work.destroy', $work->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                              <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                              {{ Form::close() }}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

@endsection
