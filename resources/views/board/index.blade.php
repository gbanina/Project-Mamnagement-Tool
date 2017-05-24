@extends('base')

@section('content')
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities</h2>
                  <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ URL::to('board/create') }}" class="btn btn-default" type="button">Add News</a>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="dashboard-widget-content">
                    <ul class="list-unstyled timeline widget">
                    @foreach($boards as $board)
                      <li>
                        <div class="block">
                          <div class="block_content">
                          <img src="{{ URL::to('images/' . $board->user->avatar) }}" style="margin-right: 10px" class="avatar" alt="Avatar">
                            <h2 class="title">
                                  {{$board->user->name}}
                                  @if($board->task_id == null)
                                    {{$board->title}}
                                  @else
                                    <a href="{{ URL::to('task/' . $board->task_id . '/edit') }}">{{$board->title}}</a>
                                  @endif
                                  @if($board->user->id == Auth::user()->id && $board->editable == 'Y')
                                    &nbsp;&nbsp;<a href="{{ URL::to('board/' . $board->id . '/edit') }}"><i class="fa fa-edit"></i></span></a>
                                  @endif
                            </h2>
                            <div class="byline">
                              <span>{{$board->timeElapsed}}</span> in <a href="{{ URL::to('project/'.$board->project->id.'/edit') }}">{{$board->project->name}}</a>
                            </div>
                            <p class="excerpt">{{$board->content}}
                            </p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
</div>
@endsection
