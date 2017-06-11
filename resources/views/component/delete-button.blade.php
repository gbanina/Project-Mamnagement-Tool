{{ Form::open(array('url' => TMBS::acc() . '/'.$url.'/'.$id, 'method' => 'delete', 'style'=>'display: inline')) }}
    <button type="submit" class="btn btn-danger btn-xs">{{ $slot }}</button>
{{ Form::close() }}
