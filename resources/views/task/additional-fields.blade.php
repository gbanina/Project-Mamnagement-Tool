@foreach($fields as $id=>$field)
    <div class="form-group">
        <label class="control-label col-md-4 col-sm-4 col-xs-12">{{$field['label']}}</label>
        <div class="col-md-8 col-sm-8 col-xs-12">
            @if($field['type'] === 'NUMBER')
                {!! Form::number('additional[' . $id . ']', $field['value'], array( $global_css, $field['disabled'], 'class' => 'form-control ')) !!}
            @elseif($field['type'] === 'INPUT')
                {!! Form::text('additional[' . $id . ']', $field['value'], array($global_css, $field['disabled'], 'class' => 'form-control ','placeholder'=>$field['label'])) !!}
            @elseif($field['type'] === 'TEXTAREA')
                {{ Form::textarea('additional[' . $id . ']', $field['value'], [$global_css, $field['disabled'], 'rows'=> '8', 'class' => 'resizable_textarea form-control']) }}
            @elseif($field['type'] === 'DATE')
                {!! Form::text('additional[' . $id . ']', $field['value'], array($global_css, $field['disabled'], 'class' => 'form-control has-feedback-left datepicket_component')) !!}
                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
            @elseif($field['type'] === 'ENUM')
                Not Implemented yet
            @elseif($field['type'] === 'CHECKBOX')
                @if($field['value'] == 'yes')
                {{ Form::checkbox('additional[' . $id . ']' , 'yes', true, ['class' => 'flat', $field['disabled']]) }}
                @else
                {{ Form::checkbox('additional[' . $id . ']' , 'yes', false, ['class' => 'flat', $field['disabled']]) }}
                @endif
            @elseif($field['type'] === 'FILE')
                Not Implemented yet
            @elseif($field['type'] === 'USER')
                {{ Form::select('additional[' . $id . ']', $users, $field['value'], array($global_css, $field['disabled'], 'class' => 'form-control')) }}
                @else
                Error reading data!!!
            @endif
        </div>
    </div>
@endforeach
