@extends('base')

@section('content')

<div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12" style="{{$viewStyle}}">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$project->name}} <small><a href="{{ URL::to('project') }}">Projects</a> | Project Rights</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                    {!! Form::open(array('url' => 'project-rights/' . $project->id)) !!}
                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                      <a href="{{ URL::to('project/'.$project->id.'/edit') }}" class="btn btn-primary" type="button">Cancel</a>

                        @include('admin.right.project')

                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                      <a href="{{ URL::to('project/'.$project->id.'/edit') }}" class="btn btn-primary" type="button">Cancel</a>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@section('js_include')
          <script>
          function chaingeChildRight(cls, val){
              $('.'+cls+" :input[value='" + val + "']").click();
            }
          </script>
@endsection
