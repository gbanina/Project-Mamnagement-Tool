
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>

            <div class="row">
            {!! Form::model($taskType, array('route' => array('task-view.update', 1), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit <strong>{{$taskType->name}}</strong> View<small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div id="row_1" class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <!-- single element -->
                      <div class="form-group" id="element_1_1_1_1">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input required="required" class="form-control " placeholder="Task Name" name="name" type="text" value="extra fields">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value=""> Required? |
                              <a onClick="delete_element('element_1_1_1_1')">Delete this field</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- single element -->


                      <div id="add_button_1" class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <a href="#" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">Add new Field Here</a>
                        </div>
                      </div>
                    </div>

                    <div id="row_2" class="col-md-6 col-sm-12 col-xs-12 form-group">
                      <!-- single element -->
                      <div class="form-group" id="element_1_1_1_1">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Name</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input required="required" class="form-control " placeholder="Task Name" name="name" type="text" value="extra fields">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" value=""> Required? |
                              <a onClick="delete_element('element_1_1_1_1')">Delete this field</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- single element -->


                      <div id="add_button_2" class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                          <a href="#" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm2">Add new Field Here</a>
                        </div>
                      </div>
                    </div>
                      </div>
                    </div>
                </div>
              </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- modals -->
                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Which Additional Field do you want to add?</h4>
                        </div>
                        <div class="modal-body">
                          @foreach($taskFields as $field)
                            <!--{{var_dump($field)}}-->
                            <p><a onClick="add_element({{$field->id}}, '{{$field->label}}', '{{$field->type}}', 1)" class="btn btn-default" data-dismiss="modal">{{$field->label}}</a></p>
                          @endforeach
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Which Additional Field do you want to add?</h4>
                        </div>
                        <div class="modal-body">
                          @foreach($taskFields as $field)
                            <!--{{var_dump($field)}}-->
                            <p><a onClick="add_element({{$field->id}}, '{{$field->label}}', '{{$field->type}}', 2)" class="btn btn-default" data-dismiss="modal">{{$field->label}}</a></p>
                          @endforeach
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
@endsection

@section('js_include')
<script>

  function delete_element(id){
    $( "#" + id ).remove();
  }
  var unique = 0;

  function add_element(id, label, type, row){
    unique++;
    var html = row_markup(id, label, type, row);
    $( "#add_button_" + row ).before( html );
  }

  function row_markup(id, label, type, row){

    /*
    if(type == 'NUMBER')
      html += '<input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    else if(type == 'INPUT')
      html += '<input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    else if(type == 'TEXTAREA')
      html += '<input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    else if(type == 'DATE')
      html += '<input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    else if(type == 'CHECKBOX')
      html += '<input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    else if(type == 'USER')
      html += '<input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    else
      html += '<p>Error!</p>';
    */

    html = '          <div class="form-group" id="element_1_1_'+row+'_'+unique+'">';
    html += '             <label class="control-label col-md-4 col-sm-4 col-xs-12">'+label+'</label>';
    html += '             <div class="col-md-8 col-sm-8 col-xs-12">';
    html += '               <input required="required" class="form-control " placeholder="'+label+'" name="name" type="text">';
    html += '               <div class="checkbox">';
    html += '                 <label>';
    html += '                   <input type="checkbox" value=""> Required? |';
    html += '                   <a onClick="delete_element(\'element_1_1_'+row+'_'+unique+'\')">Delete this field</a>';
    html += '                 </label>';
    html += '               </div>';
    html += '             </div>';
    html += '           </div>';

    return html;
  }

</script>

@endsection
