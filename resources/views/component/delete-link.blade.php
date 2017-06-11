{{ Form::open(['route' => '{accountId}.comment.destroy $id, Auth::user()->current_acc), 'method' => 'delete','id' => 'form-'.$id, 'style'=>'display: inline']) }}
    <a href="#" onclick="document.getElementById('{{'form-'.$id}}').submit();">
        <li type="submit" class="fa fa-remove fa-wide">{{ $slot }}</li>
    </a>
{{ Form::close() }}
