        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav">
                <li></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ URL::to('images/' . Auth::user()->avatar ) }}" alt="">{{Auth::user()->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                  @foreach(Auth::user()->accounts as $acc)
                      <li>
                        <a href="{{ TMBS::url('switch/'.$acc->id) }}"> {{$acc->name}}
                          @if($acc->id == Auth::user()->currentacc->id)
                            <span class="fa fa-check"></span>
                          @endif
                        </a>
                      </li>
                  @endforeach
                    <li style="border-bottom: 2px solid #E6E9ED;padding: 1px 5px 6px;"></li>
                    <li><a href="{{ URL::to('profile') }}"> Profile</a></li>
                    <li><a href="{{ URL::to('settings') }}"> Settings</a></li>
                    <li><a href="{{ URL::to('help') }}">Help</a></li>
                    <li>
                        <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </li>
                  </ul>
                </li>
                {!! TMBS::timeCounter() !!}
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </ul>
            </nav>
          </div>
