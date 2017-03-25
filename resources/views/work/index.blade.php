@extends('base')

@section('content')
<div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My work for this week <small>{{$cost}}h</small></h2>
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
                              <td>{{ Form::select('task_id', $tasks, '', array('required'=> 'required', 'class' => 'form-control')) }}</td>
                              <td>
                              {!! Form::text('date', '', array('class' => 'form-control has-feedback-left datepicket_component')) !!}

                              </td>
                              <td>
                                <input type="number" step="any"  name="cost" required class="form-control"/>
                                {{ Form::hidden('return_to', 'work') }}
                              </td>
                              <td>{!! Form::submit('Add', array('class' => 'btn btn-success')) !!}</td>
                            </tr>
                          </tbody>
                        </table>
                    {!! Form::close() !!}
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Task</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($works as $work)
                        <tr>
                          <td><a href="{{ URL::to('work/'.$work->task->id.'/edit') }}">{{$work->task->name}}</a></td>
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
              </div>
</div>
@endsection

@section('js_include')
  <script src="{{ URL::to('js/moment.min.js') }}"></script>
  <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
