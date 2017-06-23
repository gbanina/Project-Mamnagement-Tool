
@extends('base')

@section('content')
<style>

#holder {
    height: 50px;
}
#label {
    margin-bottom: -50px;
    padding-left: 14px;
    padding-top: 6px;
    position: absolute;
    color: #73879C;
    z-index: 10;
}
.tmb-element {
    font-size: 18px;
    font-weight: 400;
    padding-top: 18px;
    height: 100%;
    padding-bottom: -10px;
    border-radius:5px;
    text-align: left;
}

.tmb-button-default {
    color: #73879C;
    background: none;
    border: none;
    font-size: 17px;
    margin-bottom: 0px;
    margin-right: 0px;
    padding: 6px 6px;
}

.tmb-button-success {
    color: #169F85;
    background: none;
    border: none;
    color: #26B99A;
    font-size: 17px;
    margin-bottom: 0px;
    margin-right: 0px;
    padding: 6px 6px;
}



.bootstrap-select button {
    font-size: 18px;
    font-weight: 400;
    padding-top: 18px;
    height: 100%;
    padding-bottom: -10px;
    border-radius:5px;
    text-align: left;
}
.bootstrap-select.btn-group .dropdown-menu li a span.text {
    font-size: 15px;
}

.x_title h2 {
    margin: 10px 0 6px;
    float: left;
    display: block;
}

</style>
        <div class="clearfix"></div>
            <div class="row">
                {!! Form::open(array('url' => TMBS::url('admin/project-type'), 'class' => 'form-horizontal form-label-left')) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add new Project Type</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ WebComponents::backUrl() }}" class="btn tmb-button-default" type="button">Cancel</a>
                      {!! Form::submit('Add', array('class' => 'btn tmb-button-success')) !!}
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div id="leftNav" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="holder"> <small id="label" for="input">Project name</small>
                                <input type="email" class="form-control tmb-element" placeholder="Your Project Name Here" value="Timbiosis Ideas">
                            </div>
                        </div>


                        <div id="leftNav" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group" id="holder">
                                <small id="label">Responsible Person</small>
                                    <select class="selectpicker form-control tmb-element" data-live-search="true">
                                      <option>Dragana Juren</option>
                                      <option data-content="<span class='text'>Goran Banina</span> <img height='18' width='18' src='{{ URL::to('images/' . Auth::user()->avatar ) }}'>">Ketchup</option>
                                      <option>Dragana Madzarac</option>
                                    </select>
                            </div>
                        </div>


                        <div id="leftNav" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <small id="label">Task Description</small>
                                <textarea rows="8" class="form-control tmb-element" placeholder="Your Project Name Here" >Content</textarea>
                            </div>
                        </div>

                        <div id="leftNav" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group" id="holder">
                                <small id="label">Status</small>
                                    <select class="selectpicker form-control tmb-element" data-live-search="true">
                                      <option>Dragana Juren</option>
                                      <option data-content="<span class='text'>Goran Banina</span> <img height='18' width='18' src='{{ URL::to('images/' . Auth::user()->avatar ) }}'>">Ketchup</option>
                                      <option>Dragana Madzarac</option>
                                    </select>
                            </div>
                        </div>

                        <div id="leftNav" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group" id="holder">
                                <small id="label">Priority</small>
                                    <select class="selectpicker form-control tmb-element" data-live-search="true">
                                      <option>Dragana Juren</option>
                                      <option data-content="<span class='text'>Goran Banina</span> <img height='18' width='18' src='{{ URL::to('images/' . Auth::user()->avatar ) }}'>">Ketchup</option>
                                      <option>Dragana Madzarac</option>
                                    </select>
                            </div>
                        </div>

                          <div id="leftNav" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group" id="holder">
                                <small id="label">Start Date</small>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class=" form-control tmb-element" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                          <div id="leftNav" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group" id="holder">
                                <small id="label">End Date</small>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class=" form-control tmb-element" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                      </div>

                </div>
              </div>

              </div>
              </div>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
@endsection

@section('js_include')
  <script src="{{ URL::to('js/select/bootstrap-select.js')}}"></script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                  format: 'DD/MM/YYYY',
                  defaultDate: "11/1/2013"
                });
            });
             $(function () {
                $('#datetimepicker2').datetimepicker({
                  format: 'DD/MM/YYYY',
                  defaultDate: "11/1/2013"
                });
            });
        </script>
@endsection
