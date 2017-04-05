
@extends('base')

@section('content')
       <div class="">
            <div class="clearfix"></div>

            <div class="row">
            {!! Form::model($taskType, array('route' => array('task-view.update', 1), 'method' => 'PUT', 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit <strong>{{$taskType->name}}</strong> View<small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div id="row_1" class="col-md-6 col-sm-12 col-xs-12 form-group">
                    <ul id="foo" class="drag-n-drop-ul">
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
                    <ul id="bar" class="drag-n-drop-ul">
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
                </div>

              <div class="col-md-3 col-sm-12 col-xs-12">
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
  <script src="{{ URL::to('js/moment.min.js') }}"></script>
  <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
  <script src="{{ URL::to('js/drag/Sortable.min.js')}}"></script>
  <script src="{{ URL::to('js/drag/app.js')}}"></script>
@endsection
