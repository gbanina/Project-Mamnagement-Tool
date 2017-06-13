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
                <h3> @component('component.account-link')
                     @endcomponent
                </h3>
                <ul class="nav side-menu">
                  <li><a href="{{ TMBS::url('board') }}"><i class="fa fa-laptop"></i> Boards {!! WebComponents::boardEvents() !!}</a></li>
                  <li><a href="{{ TMBS::url('work') }}"><i class="fa fa-cubes"></i> My Work </a></li>
                  <!--<li><a href="{{ TMBS::url('/team') }}"><i class="fa fa-users"></i> My Team </a></li>-->
                  <li><a><i class="fa fa-sitemap"></i> Projects <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ TMBS::url('project') }}">All Projects</a></li>
                      <li><a href="{{ TMBS::url('project/create') }}">Add New Project</a></li>
                      <li><a href="{{ TMBS::url('project-plan') }}">Project Plan</a></li>
                      <!-- <li><a href="form_advanced.html">Project Settings</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Tasks <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ TMBS::url('task') }}">All Tasks</a></li>
                      <!--<li><a href="{{ TMBS::url('task/create') }}">Add New Task</a></li>-->
                      <!-- <li><a href="media_gallery.html">Task Settings</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ TMBS::url('users') }}">All Users</a></li>
                      <li><a href="{{ TMBS::url('admin/role') }}">User Role</a></li>
                      <li><a href="{{ TMBS::url('admin/right') }}">User Rights</a></li>
                    </ul>
                  </li>
                  @if(Auth::user()->isAdmin())
                  <li><a><i class="fa fa-key"></i> Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ TMBS::url('admin/project-type') }}">Project Types</a></li>
                      <li><a href="{{ TMBS::url('admin/task-type') }}">Task Types</a></li>
                      <li><a href="{{ TMBS::url('admin/field') }}">Available Fields</a></li>
                      <li><a href="{{ TMBS::url('admin/task-view') }}">Task Views</a></li>
                      <li><a href="{{ TMBS::url('admin/status') }}">Task Status</a></li>
                      <li><a href="{{ TMBS::url('admin/priority') }}">Task Priority</a></li>
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="{{ URL::to('settings') }}" data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a href="{{ URL::to('profile') }}" data-toggle="tooltip" data-placement="top" title="Profile">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <a href="{{ URL::to('help') }}" data-toggle="tooltip" data-placement="top" title="Help">
                <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ URL::to('logout') }}" >
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
