            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>TeamBiosis</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ URL::to('images/' . Auth::user()->avatar ) }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ URL::to('/') }}"><i class="fa fa-laptop"></i> Dashboard <span class="label label-success pull-right">3 New Events</span></a></li>
                  <li><a><i class="fa fa-sitemap"></i> Projects <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ URL::to('project') }}">All Projects</a></li>
                      <li><a href="{{ URL::to('project/create') }}">Add New Project</a></li>
                      <!-- <li><a href="form_advanced.html">Project Settings</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Tasks <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ URL::to('task') }}">All Tasks</a></li>
                      <li><a href="{{ URL::to('task/create') }}">Add New Task</a></li>
                      <!-- <li><a href="media_gallery.html">Task Settings</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ URL::to('users') }}">All Users</a></li>
                      <li><a href="{{ URL::to('users/create') }}">Add New User</a></li>
                      <li><a href="{{ URL::to('admin/role') }}">User Role</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-key"></i> Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ URL::to('admin/project-type') }}">Project Types</a></li>
                      <!--
                      <li><a href="{{ URL::to('task/types') }}">Task Types</a></li>
                      <li><a href="{{ URL::to('task/attributes') }}">Task Attributes</a></li>
                      <li><a href="{{ URL::to('task/status') }}">Task Status</a></li>
                      <li><a href="{{ URL::to('task/priority') }}">Task Priority</a></li>
                      -->
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>My Projects</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Notes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">My Notes</a></li>
                      <li><a href="#">Add New Note</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ URL::to('logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
