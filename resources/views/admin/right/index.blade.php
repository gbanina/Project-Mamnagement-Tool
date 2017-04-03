@extends('base')

@section('content')


        <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12" style="{{$viewStyle}}">
                    {!! Form::open(array('url' => 'admin/right')) !!}
                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                      @foreach($projects as $project)
                        @include('admin.right.project')
                      @endforeach
                      {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                    {!! Form::close() !!}
              </div>
            </div>
@endsection

@section('js_include')
          <script>
          $( document ).ready(function() {
              $(".collapse-link").click();
          });
          function chaingeChildRight(cls, val){
              $('.'+cls+" :input[value='" + val + "']").click();
            }

             $(".hidden-project-right-fields").hide();
          </script>
@endsection
