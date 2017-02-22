@extends('base')

@section('content')
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recent Activities <small><a href="{{ URL::to('board/create') }}" class="btn btn-default" type="button">Add News</a></small></h2>
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
                  <div class="dashboard-widget-content">
                    <ul class="list-unstyled timeline widget">
                    @foreach($boards as $board)

                      <li>
                        <div class="block">
                          <div class="block_content">
                            <h2 class="title">
                                  <a>{{$board->title}}</a> on <a href="{{ URL::to('project/'.$board->project->id.'/edit') }}">{{$board->project->name}}</a>
                                  @if($board->user->id == Auth::user()->id)
                                    &nbsp;&nbsp;<a href="{{ URL::to('board/' . $board->id . '/edit') }}"><i class="fa fa-edit"></i></span></a>
                                  @endif
                            </h2>
                            <div class="byline">
                              <span>{{$board->timeElapsed}}</span> by <a>{{$board->user->name}}</a>
                            </div>
                            <p class="excerpt">{{$board->content}} <a>Read&nbsp;More</a>
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
@endsection
