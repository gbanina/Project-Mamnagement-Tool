{{ Form::open(['route' => [$route, $id], 'method' => 'delete', 'style'=>'display: inline']) }}
    <button type="submit" class="btn btn-danger btn-xs">{{ $slot }}</button>
{{ Form::close() }}
