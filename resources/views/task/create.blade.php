@extends('base')

@section('content')
        <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Tasks <small>Listing design</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Task <small>in - Project Name</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="task-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="task-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control">
                            <option>Task</option>
                            <option>Sub Task</option>
                            <option>Feature</option>
                            <option>Story</option>
                            <option>Epic</option>
                            <option>Bug</option>
                            <option>Test</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="priority" class="control-label col-md-3 col-sm-3 col-xs-12">Priority</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control">
                            <option>Minor</option>
                            <option>Low</option>
                            <option>Normal</option>
                            <option>Major</option>
                            <option>High</option>
                            <option>Critical</option>
                            <option>Blocker</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="responsible" class="control-label col-md-3 col-sm-3 col-xs-12">Responsible person</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control">
                            <option>Minor</option>
                            <option>Low</option>
                            <option>Normal</option>
                            <option>Major</option>
                            <option>High</option>
                            <option>Critical</option>
                            <option>Blocker</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="responsible" class="control-label col-md-3 col-sm-3 col-xs-12">Estimated end date </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control">
                            <option>Open</option>
                            <option>In progress</option>
                            <option>Finished</option>
                            <option>In test</option>
                            <option>Resolved</option>
                            <option>Closed</option>
                          </select>
                        </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Estemated Cost <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>



@endsection

@section('js_include')
    <script src="{{ URL::to('js/moment.min.js') }}"></script>
    <script src="{{ URL::to('js/daterangepicker.js') }}"></script>
@endsection
