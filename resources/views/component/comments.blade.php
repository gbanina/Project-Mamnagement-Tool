<div class="x_panel">
    <div class="x_title">
        <h2>Comments</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
          {!! Form::open(array('url' => 'comment', 'class' => 'form-horizontal form-label-left')) !!}
              {{ Form::textarea('data', '', ['rows'=> '8','id'=>'comment_data', $global_css, 'class' => 'resizable_textarea form-control', 'placeholder'=>'Write a comment']) }}
                  {{ Form::hidden('entity_id', $id, ['id' => 'entity_id']) }}
                  {{ Form::hidden('entity_type', $type, ['id' => 'entity_type']) }}
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <br>
                  @if($global_css != 'disabled')
                    <a onClick="add_comment()" {{$global_css}} class="btn btn-default" type="button">Add</a>
                  @endif
              {!! Form::close() !!}
              <div class="ln_solid"></div>
              <br>
                <ul class="messages">
                    @foreach($comments as $comment)
                      @if($comment->type == 'COMMENT')
                          <li>
                            <img src="{{ URL::to('images/' . $comment->user->avatar ) }}" class="avatar" alt="Avatar">
                            <div class="message_wrapper">
                              <h4 class="heading">
                                {{$comment->user->name}} <small>({{$comment->timeElapsed}})</small>
                                @if($comment->user->id == Auth::user()->id && $global_css != 'disabled')
                                  @component('component.delete-link', ['id' => $comment->id, 'route' => 'comment.destroy'])
                                  @endcomponent
                                @endif

                              </h4>
                              <blockquote class="message">{{$comment->data}}</blockquote>
                            </div>
                          </li>
                      @else
                      <li>
                        <div class="message_wrapper wrapper_note">
                          <blockquote class="note">{{$comment->data}}<small>{{$comment->timeElapsed}}</small></blockquote>
                        </div>
                      </li>
                      @endif
                    @endforeach
                </ul>
    </div>
</div>
<script>
function add_comment()
{
      $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST", //PUT
            url: "{{ URL::to('comment')}}", // ide na update metodu
            data: {data: $("#comment_data").val(), entity_id: $("#entity_id").val(), entity_type: $("#entity_type").val()},
            success: function( msg ) {
              new PNotify({
                  title: 'Success',
                  text: 'Your comment has been saved successfully!',
                  type: 'alert-success',
                  styling: 'bootstrap3'
              });
              $content = comment_append_content();
              $( ".messages" ).prepend( $content );
            }

        });
}
function comment_append_content()
{
    var result = '';
    result += '                      <li>';
    result += '                        <img src="{{ URL::to('images/' . Auth::user()->avatar ) }}" class="avatar" alt="Avatar">';
    result += '                        <div class="message_wrapper">';
    result += '                          <h4 class="heading">';
    result += '                           {{Auth::user()->name}}';
    result += '                         </h4>';
    result += '                          <blockquote class="message">'+$("#comment_data").val()+'<small>Now</small></blockquote>';
    result += '                          <br>';
    result += '                        </div>';
    result += '                      </li>';

    return result;
}
</script>
