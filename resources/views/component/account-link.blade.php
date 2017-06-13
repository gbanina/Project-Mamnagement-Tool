@if(TMBS::isOwner())
<input id="account_name" onchange="account_rename()" class="form-control editable-account" type="text" value="{{Auth::user()->currentacc->name}}">
@else
    <div class="account-text-title">
    {{Auth::user()->currentacc->name}}
    </div>
@endif
<li style="list-style-type:none;"><a><span class="fa fa-chevron-down main-menu-account-list"></span></a>

                    <ul class="nav child_menu">
                      @foreach(Auth::user()->accounts as $acc)
                        @if($acc->id != Auth::user()->currentacc->id)
                          <li>
                            <a href="{{ TMBS::url('switch/'.$acc->id) }}"> {{$acc->name}}
                            </a>
                          </li>
                        @endif
                      @endforeach
                    </ul>
                  </li>
    <script>
    function account_rename()
    {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('account-rename')}}",
            data: {data: $("#account_name").val()},
            success: function( msg ) {
              // do nothing
              console.log(msg);
            }
        });
    }
    </script>
