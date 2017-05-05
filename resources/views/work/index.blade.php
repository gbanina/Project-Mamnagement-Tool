@extends('base')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My tasks ({{$tasksCount}})</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @include('work.tasks')
                    <h2>My work for this week <small>{{$cost}}h</small></h2>
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
                        @if($work->task != null)
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
                        @endif
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
