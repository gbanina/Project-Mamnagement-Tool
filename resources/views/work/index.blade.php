@extends('base')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My Work</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                          <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">My tasks ({{$tasksCount}})</a>
                        </li>
                        <li role="presentation" class="">
                          <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">My work for this week ({{$cost}}h)</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          @include('work.tasks')
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          @include('work.work')
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>
@endsection

@section('js_include')
    <script src="{{ URL::to('js/table/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::to('js/table/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.datatables.net/colreorder/1.3.3/js/dataTables.colReorder.min.js"></script>
   <script>
      var table = $('#advanced-table').DataTable({
        //stateSave: true,
        select: true,
        //colReorder: true
    });
    var search_id = table.columns( table.colReorder.transpose( 0 ) ).search();
    $('#id-filter').val(search_id[0]);
    $('#id-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 0 ) ).search( this.value ).draw();
    });
    var search_name = table.columns( table.colReorder.transpose( 1 ) ).search();
    $('#name-filter').val(search_name[0]);
    $('#name-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 1 ) ).search( this.value ).draw();
    });/*
    var search_projects = table.columns( table.colReorder.transpose( 3 ) ).search();
    $('#project-filter').val(search_projects[0]);
    $('#project-filter').on( 'keyup change', function () {
        table.columns( table.colReorder.transpose( 3 ) ).search( this.value ).draw();
    });*/
        var search_status = table.columns( table.colReorder.transpose( 2 ) ).search();
    $('#status_id-filter').val(search_status[0]);
    $('#status_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 2 ) ).search( this.value ).draw();
    });
    var search_type = table.columns( table.colReorder.transpose( 3 ) ).search();
    $('#type_id-filter').val(search_type[0]);
    $('#type_id-filter').on( 'change', function () {
        table.columns( table.colReorder.transpose( 3 ) ).search( this.value ).draw();
    });

    </script>
  <script src="{{ URL::to('js/moment.min.js') }}"></script>
  <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
  <script>
  $( document ).ready(function() {
      $(".calendar-week").datepicker({
        showWeek: true,
        onSelect: function(dateText, inst) {
            $(this).val("'Week Number '" + $.datepicker.iso8601Week(new Date(dateText)));
        }
    });
});

  </script>
@endsection
