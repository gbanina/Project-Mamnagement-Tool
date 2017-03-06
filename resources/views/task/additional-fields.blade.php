@foreach($fields as $id=>$field)
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12">{{$field['label']}}</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
            @if($field['type'] === 'NUMBER')
                {!! Form::number('additional[' . $id . ']', $field['value'], array( 'class' => 'form-control ')) !!}
            @elseif($field['type'] === 'INPUT')
                {!! Form::text('additional[' . $id . ']', $field['value'], array('class' => 'form-control ','placeholder'=>$field['label'])) !!}
            @elseif($field['type'] === 'TEXTAREA')
                {{ Form::textarea('additional[' . $id . ']', $field['value'], ['rows'=> '8', 'class' => 'resizable_textarea form-control']) }}
            @elseif($field['type'] === 'DATE')
                Not Implemented yet
            @elseif($field['type'] === 'ENUM')
                Not Implemented yet
            @elseif($field['type'] === 'CHECKBOX')
                Not Implemented yet
            @elseif($field['type'] === 'FILE')
                Not Implemented yet
            @elseif($field['type'] === 'USER')
                Not Implemented yet
            @else
                Error reading data!!!
            @endif
        </div>
    </div>
@endforeach
