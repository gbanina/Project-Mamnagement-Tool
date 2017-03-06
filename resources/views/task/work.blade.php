<div class="x_panel" style="height: auto;">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Logged hours for <strong>{{$task->name}}</strong></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
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
                  <div class="x_content" style="display: none;">
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                             <table class="table">
                                <thead>
                                  <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($task->work as $work)
                                  <tr>
                                    <td>{{$work->user->name}}</td>
                                    <td>{{$work->created_at}}</td>
                                    <td>{{$work->cost}}h</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
