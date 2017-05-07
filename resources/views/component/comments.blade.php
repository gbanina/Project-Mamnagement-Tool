<div class="x_panel">
    <div class="x_title">
        <h2>Comments</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
          {!! Form::open(array('url' => 'comment', 'class' => 'form-horizontal form-label-left')) !!}
              {{ Form::textarea('data', '', ['rows'=> '8','id'=>'comment_data', 'class' => 'resizable_textarea form-control', 'placeholder'=>'Write a comment']) }}
                  {{ Form::hidden('entity_id', $id, ['id' => 'entity_id']) }}
                  {{ Form::hidden('entity_type', $type, ['id' => 'entity_type']) }}
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  <br>
                  <a onClick="add_comment()" class="btn btn-success" type="button">Save</a>
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
    result += '                        <div class="message_date">';
    result += '                          <h3 class="date text-info"></h3>';
    result += '                          <p class="month">Now</p>';
    result += '                        </div>';
    result += '                        <div class="message_wrapper">';
    result += '                          <h4 class="heading">';
    result += '                           {{Auth::user()->name}}';
    result += '                         </h4>';
    result += '                          <blockquote class="message">'+$("#comment_data").val()+'</blockquote>';
    result += '                          <br>';
    result += '                        </div>';
    result += '                      </li>';

    return result;
}
</script>
