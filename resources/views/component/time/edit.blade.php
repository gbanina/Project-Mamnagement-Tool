                  <div class="modal fade bs-edit-modal-sm-{{$work->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Edit time for {{$task->name}}</h4>
                        </div>
                        {!! Form::open(array('url' => TMBS::url('work-edit-time/' . $work->id), 'class' => 'form-horizontal form-label-left')) !!}
                        <div class="modal-body">

                          <div class="container">

                                  <div class="form-group">
                                      <p>Task</p>
                                      <div class='input-group' id='task-{{$work->id}}'>
                                          {{ WebComponents::myTasks($work->task_id) }}
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <p>Start</p>
                                      <div class='input-group date' id='datetimepicker6-w-{{$work->id}}'>
                                          <input type='text' name="start_time" class="form-control" />
                                          <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                          </span>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <p>End</p>
                                      <div class='input-group date' id='datetimepicker7-w-{{$work->id}}'>
                                          <input type='text' name="end_time" value="" class="form-control" />
                                          <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                          </span>
                                      </div>
                                  </div>

                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}

                      </div>
                    </div>
                  </div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker6-w-{{$work->id}}').datetimepicker({
            sideBySide: true,
            defaultDate: "{{$work->start_time}}",
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker7-w-{{$work->id}}').datetimepicker({
            useCurrent: false,
            sideBySide: true,
            defaultDate: "{{$work->end_time}}",
            format: 'YYYY-MM-DD HH:mm'
        });
        $("#datetimepicker6-w-{{$work->id}}").on("dp.change", function (e) {
            $('#datetimepicker7-{{$work->id}}').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7-w-{{$work->id}}").on("dp.change", function (e) {
            $('#datetimepicker6-{{$work->id}}').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
