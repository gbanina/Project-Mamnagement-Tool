{!! Form::open(
    array(
        'url' => 'file-upload/'.$task->id.'/',
        'class' => 'form',
        'novalidate' => 'novalidate',
        'files' => true)) !!}

    {!! Form::file('file', ['id' => 'file_button']) !!}

    {!! Form::submit('Upload image!', ['id' => 'file_submit']) !!}
{!! Form::close() !!}

<div class="x_panel">
    <div class="x_title">
        <h2>File Attachments</h2>
        <div class="header-buttons">
            <a onclick="$( '#file_button' ).trigger( 'click' );" class="btn btn-default" type="button">Upload</a>
        </div>

        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <ul class="list-unstyled project_files">
            @foreach($task->files as $file)
                <li>
                    <a href="{{ URL::to('storage/' . $file->path)}}" target="_blank"><i class="fa fa-file-archive-o"></i>{{$file->name}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<script>
$("document").ready(function(){
    $("#file_button").change(function() {
        $( '#file_submit' ).trigger( 'click' );
    });
});
</script>
