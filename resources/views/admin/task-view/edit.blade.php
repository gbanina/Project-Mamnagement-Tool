
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>
            {!! Form::model($taskType, array('route' => array('task-view.update', 1), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
            <div class="row">
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit <strong>{{$taskType->name}}</strong> View<small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <div id="red_1">
                      <div id="row_buttons_1" class="text-center row-buttons" style="display: none;padding-bottom: 15px;">
                          <div class="btn-group btn-transparent" data-toggle="buttons">
                            <label onClick="one_column_row(1)" class="btn btn-default">
                              <input type="radio" name="options" id="row_option_one_1"> One Column
                            </label>
                            <label onClick="two_column_row(1)"class="btn btn-default active">
                              <input type="radio" name="options" id="row_option_two_1"> Two Columns
                            </label>
                            <label onClick="three_column_row(1)" class="btn btn-default">
                              <input type="radio" name="options" id="row_option_three_1"> Three Columns
                            </label>
                          </div>
                          <a onClick="delete_row(1)" id="add_new_button" class="btn btn-default btn-transparent btn-round pull-right"><i class="fa fa-times"></i></a>
                      </div>

                      <div id="rows_1">
                          <div id="row_1" class="col-md-6 col-sm-12 col-xs-12 form-group">
                          <ul id="foo" class="drag-n-drop-ul red_1_list">
                            <!-- single element -->
                            <li>
                              <div class="form-group" id="element_1_1_1_1">
                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Name</label>
                                <div class="col-md-8 col-sm-8 col-xs-12 possibly-hide">
                                  <input required="required" class="form-control " placeholder="Task Name" name="name" type="text">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" value=""> Required?
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <!-- single element -->
                            </ul>
                          </div>

                          <div id="row_2" class="col-md-6 col-sm-12 col-xs-12 form-group">
                          <ul id="bar" class="drag-n-drop-ul red_1_list">
                          <li>
                            <!-- single element -->
                            <div class="form-group" id="element_1_1_1_1">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12">Estimated Cost</label>
                              <div class="col-md-8 col-sm-8 col-xs-12 possibly-hide">
                                <input =""="" class="form-control " name="estimated_cost" type="number">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value=""> Required?
                                  </label>
                                </div>
                              </div>
                            </div>
                            <!-- single element -->
                            </li>
                            </ul>
                          </div>
                      </div>

                  </div>

                  <div id="red_add">
                    <div id="row_new" class="col-md-12 col-sm-12 col-xs-12">
                      <ul id="add_zone" class="drag-n-drop-ul">
                      <li></li>
                      </ul>
                    </div>
                  </div>

                      </div>
                    </div>
                </div>

              <div id="possible_container" class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Possible fields</h2>
                    <div class="clearfix"></div>
                  </div>
                    <div class="x_content">

                    <ul id="possible" class="drag-n-drop-ul possible-list">
                    @foreach($taskFields as $id => $field)
                    <li>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">{{$field->label}}</label>
                        <div class="col-md-8 col-sm-8 col-xs-12 possibly-hide">
                          @component('component.additional-field', ['field' => $field, 'id' => $id, 'global_css' => '', 'users' => $users])
                          @endcomponent
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value=""> Required?
                            </label>
                          </div>
                        </div>
                      </div>
                    </li>
                    @endforeach
                    </ul>
                    </div>
                  </div>
                  </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>

@endsection

@section('js_include')
<script>

$(window).scroll(function() {
  var $h1 = $("#possible_container");
  var window_offset = $h1.offset().top - $(window).scrollTop();
  $("#possible_container").css({ "top":($(window).scrollTop() + 0) +"px"});
});

var row_count = 1;

  function enable_buttons(id){
      $( "#red_" + id ).children().hover(
      function() {
        $( "#red_" + id ).children('.row-buttons').show();
      }, function() {
        $( "#red_" + id ).children('.row-buttons').hide();
      }
);
  }
  enable_buttons(1);

  function add_new_element(item){
    row_count++;
    $( add_empty_row(row_count, item) ).insertBefore( "#red_add" );
    $( "#add_zone > li" ).remove();

    enable_buttons(row_count);
    init_drop_zone(row_count)
  }

  function init_drop_zone(id)
  {
    Sortable.create(document.getElementById('drop_zone_'+id), {
      group: "words",
      animation: 150,
      onAdd: function (evt){ console.log('onAdd.possible:', evt); },
      onUpdate: function (evt){ console.log('onUpdate.possible:', evt.item); },
      onRemove: function (evt){ console.log('onRemove.possible:', evt.item); },
      onStart:function(evt){ console.log('onStart.possible:', evt.item);},
      onEnd: function(evt){ console.log('onEnd.possible:', evt.item);}
    });
  }

  function delete_row(id)
  {
    $(".red_"+id+"_list").each(function( index ) {
      $( this ).children().each(function( index ) {
        $("#possible").append( '<li>' + $( this ).html() + '</li>');
      });
    });
    $("#red_"+id).remove();
  }

  function move_element()
  {

  }

function add_empty_row(id, item){
  var html = '';
    html += '                  <div id="red_'+id+'">';
    html += '                  <div id="row_buttons_'+id+'" class="text-center row-buttons" style="display: none;padding-bottom: 15px;">';
    html += '                      <div class="btn-group btn-transparent" data-toggle="buttons">';
    html += '                        <label onClick="one_column_row('+id+')" class="btn btn-default">';
    html += '                          <input type="radio" name="options" id="option1"> One Column';
    html += '                        </label>';
    html += '                        <label onClick="two_column_row('+id+')" class="btn btn-default active">';
    html += '                          <input type="radio" name="options" id="option2"> Two Columns';
    html += '                        </label>';
    html += '                        <label onClick="three_column_row('+id+')" class="btn btn-default">';
    html += '                          <input type="radio" name="options" id="option3"> Three Columns';
    html += '                        </label>';
    html += '                      </div>';
    html += '                      <a id="add_new_button" onClick="delete_row('+id+')" class="btn btn-default btn-transparent btn-round pull-right"><i class="fa fa-times"></i></a>';
    html += '                  </div>';
    html += '                <div id="rows_'+id+'">';
    html += '                  <div id="row_1" class="col-md-12 col-sm-12 col-xs-12 form-group">';
    html += '                  <ul id="drop_zone_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    html +=                       item.outerHTML;
    html += '                    </ul>';
    html += '                  </div>';
    html += '                </div>';
    html += '             </div>';

    return html;
}
function get_row_elements(id)
{
    var result = [];
    $( "#rows_" + id + " ul" ).each(function(i){
         result.push($(this).html());
      });
    return result;
}
function one_column_row(id)
{
    var rowElements = get_row_elements(id);
    var html = '';
    html += '      <div id="rows_'+id+'">';
    html += '        <div id="row_'+id+'" class="col-md-12 col-sm-12 col-xs-12 form-group">';
    html += '        <ul id="drop_zone_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    html +=             rowElements.join(" ");
    html += '          </ul>';
    html += '        </div>';
    html += '      </div>';

    $('#rows_'+id).replaceWith( html );
    init_drop_zone(id);
    enable_buttons(id);
}

function two_column_row(id)
{
    var rowElements = get_row_elements(id);
    var html = '';
    html += '      <div id="rows_'+id+'">';
    html += '        <div id="row_a_'+id+'" class="col-md-6 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_a_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    if (rowElements[0] != undefined) {
        html +=             rowElements[0];
    }
    if (rowElements[2] != undefined) {
        html +=             rowElements[2];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '        <div id="row_b_'+id+'" class="col-md-6 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_b_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    if ( rowElements[1] != undefined ) {
        html +=             rowElements[1];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '      </div>';

    $('#rows_'+id).replaceWith( html );
    init_drop_zone('a_' + id);
    init_drop_zone('b_' + id);
    enable_buttons(id);
}

function three_column_row(id)
{
    var rowElements = get_row_elements(id);
    var html = '';
    html += '      <div id="rows_'+id+'">';
    html += '        <div id="row_a_'+id+'" class="col-md-4 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_a_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    if (rowElements[0] != undefined) {
        html +=             rowElements[0];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '        <div id="row_b_'+id+'" class="col-md-4 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_b_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    if (rowElements[1] != undefined) {
        html +=             rowElements[1];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '        <div id="row_c_'+id+'" class="col-md-4 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_c_'+id+'" class="drag-n-drop-ul red_'+id+'_list">';
    if (rowElements[2] != undefined) {
        html +=             rowElements[2];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '      </div>';

    $('#rows_'+id).replaceWith( html );
    init_drop_zone('a_' + id);
    init_drop_zone('b_' + id);
    init_drop_zone('c_' + id);
    enable_buttons(id);
}
</script>
  <script src="{{ URL::to('js/moment.min.js') }}"></script>
  <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
  <script src="{{ URL::to('js/drag/Sortable.min.js')}}"></script>
  <script src="{{ URL::to('js/drag/app.js')}}"></script>
  <script>
    Sortable.create(document.getElementById('possible'), {
    group: "words",
    animation: 150,
    onAdd: function (evt){ console.log('onAdd.possible:', evt); },
    onUpdate: function (evt){ console.log('onUpdate.possible:', evt.item); },
    onRemove: function (evt){ console.log('onRemove.possible:', evt.item); },
    onStart:function(evt){ console.log('onStart.possible:', evt.item);},
    onEnd: function(evt){ console.log('onEnd.possible:', evt.item);}
  });
  </script>
@endsection
