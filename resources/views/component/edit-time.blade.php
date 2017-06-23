                  <div class="modal fade bs-example-modal-sm-{{$task->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Add time to {{$task->name}}</h4>
                        </div>
                        {!! Form::open(array('url' => TMBS::url('work-add-time/' . $task->id), 'class' => 'form-horizontal form-label-left')) !!}
                        <div class="modal-body">

                          <div class="container">

                                  <div class="form-group">
                                      <p>Start</p>
                                      <div class='input-group date' id='datetimepicker6-{{$task->id}}'>
                                          <input type='text' name="start_time" class="form-control" />
                                          <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                          </span>
                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <p>End</p>
                                      <div class='input-group date' id='datetimepicker7-{{$task->id}}'>
                                          <input type='text' name="end_time" class="form-control" />
                                          <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                          </span>
                                      </div>
                                  </div>



                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}

                      </div>
                    </div>
                  </div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker6-{{$task->id}}').datetimepicker({
            sideBySide: true,
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker7-{{$task->id}}').datetimepicker({
            useCurrent: false,
            sideBySide: true,
            format: 'YYYY-MM-DD HH:mm'
        });
        $("#datetimepicker6-{{$task->id}}").on("dp.change", function (e) {
            $('#datetimepicker7-{{$task->id}}').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7-{{$task->id}}").on("dp.change", function (e) {
            $('#datetimepicker6-{{$task->id}}').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
