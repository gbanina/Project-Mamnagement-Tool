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

            <!-- default elements -->

            @elseif($field['type'] === 'NAME')
                {!! Form::text('name', $task->name, array('required' => 'required', $field['disabled'],'class' => 'form-control ','placeholder'=>'Name')) !!}
             @elseif($field['type'] === 'RESPONSIBLE')
                {{ Form::select('responsible_id', $users, '', array('id' => 'responsible_id', 'class' => 'form-control', 'required')) }}
            @elseif($field['type'] === 'RESPONSIBLES')
                {{ Form::select('responsible_id', $users, '', array('id' => 'responsible_id', $field['disabled'],'class' => 'form-control', 'required')) }}
                <a id="add_responsible" class="btn btn-default">Add</a>
                              <div id="responsible_container">
                                @foreach($responsibles as $responsible)
                                    <div id="responsible_item_{{$responsible->user->id}}">
                                      {{$responsible->user->name}} <a href="#" onClick="removeUser({{$responsible->user->id}})"><i class="fa fa-remove"></i></a>
                                      {{ Form::hidden('responsible_user[' . $responsible->user->id. ']', $responsible->user->id) }}
                                    </div>
                                 @endforeach
                              </div>
                    <script>
                        var resp = [];
                    @foreach($usersO as $user)
                          resp[{{$user->user->id}}] = '{{$user->user->name}}';
                        @endforeach
                          $( "#add_responsible" ).click(function() {
                             var id = $('#responsible_id').val();
                             //alert(id);
                             if ( $( '#responsible_item_'+id ).length == '0' || $( '#responsible_item_'+id ).length == 0) {
                                var str = '<div id="responsible_item_'+id+'">';
                                 str += resp[id] + '<i class="fa fa-remove"></i>';
                                 str +=  '<input name="responsible_user['+id+']" type="hidden" value="'+id+'">';
                                 str += '</div>';
                                 $( "#responsible_container" ).append( str );
                             }else{
                              alert('User already in the list!');
                             }
                            });
                          function removeUser(id){
                            $( '#responsible_item_'+id ).remove();
                          }
                        </script>
           @elseif($field['type'] === 'STATUS')
                {{ Form::select('status_id', $status, $task->status_id, array($field['disabled'],'class' => 'form-control', 'required')) }}
           @elseif($field['type'] === 'PRIORITY')
                {{ Form::select('priority_id', $priorities, $task->priority_id, array($field['disabled'],'class' => 'form-control', 'required')) }}
           @elseif($field['type'] === 'ESTIMATED_START_DATE')
                {!! Form::text('estimated_start_date', $task->estimatedStartDate, array($field['disabled'],'id' => 'single_cal3', 'class' => 'form-control has-feedback-left')) !!}
                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
            @elseif($field['type'] === 'ESTIMATED_END_DATE')
                    {!! Form::text('estimated_end_date', $task->estimatedEndDate, array($field['disabled'], 'id' => 'single_cal4', 'class' => 'form-control has-feedback-left')) !!}
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                    <span id="inputSuccess2Status3" class="sr-only">(success)</span>
            @elseif($field['type'] === 'ESTIMATED_COST')
                {!! Form::number('estimated_cost', $task->estimated_cost, array($field['disabled'], 'class' => 'form-control ')) !!}
            @elseif($field['type'] === 'WORK')
                @include('task.work')
            @elseif($field['type'] === 'COMMENTS')
                @component('component.comments', ['id' => $task->id, 'type' => 'TASK', 'comments' => $comments]) @endcomponent
            @else
                Error reading data!!!
            @endif

