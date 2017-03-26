<div class="x_panel">
    <div class="x_title">
        <h2>Comments</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
          {!! Form::open(array('url' => 'comment', 'class' => 'form-horizontal form-label-left')) !!}
              {{ Form::textarea('data', '', ['rows'=> '8', 'class' => 'resizable_textarea form-control', 'placeholder'=>'Write a comment']) }}
                  {{ Form::hidden('entity_id', $id) }}
                  {{ Form::hidden('entity_type', $type) }}
                  <br>
                  {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
              {!! Form::close() !!}
              <div class="ln_solid"></div>
              <br>
                <ul class="messages">
                    @foreach($comments as $comment)
                          <li>
                            <img src="{{ URL::to('images/' . $comment->user->avatar ) }}" class="avatar" alt="Avatar">
                            <div class="message_date">
                              <h3 class="date text-info"></h3>
                              <p class="month">{{$comment->timeElapsed}}</p>
                            </div>
                            <div class="message_wrapper">
                              <h4 class="heading">
                                {{$comment->user->name}}
                                @if($comment->user->id == Auth::user()->id)
                                  @component('component.delete-link', ['id' => $comment->id, 'route' => 'comment.destroy'])
                                  @endcomponent
                                @endif
                              </h4>
                              <blockquote class="message">{{$comment->data}}</blockquote>
                              <br>
                              <!--
                              <p class="url">
                                <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                              </p>
                              -->
                            </div>
                          </li>
                    @endforeach
                </ul>
    </div>
</div>
