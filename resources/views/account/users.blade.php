
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Type</th>
                          <th>Role</th>
                          <th>Created</th>
                          <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($users[$acc->id] as $usrAcc)
                          <tr>
                          <th scope="row">{{$usrAcc->user->id}}</th>
                          <td>{{$usrAcc->user->name}}</td>
                          <td>{{$usrAcc->user->email}}</td>
                          <td>{{$usrAcc->type}}</td>
                          <td>{{$usrAcc->role->name}}</td>
                          <td>{{$usrAcc->user->created_at}}</td>
                            <td>
                              <li style="display: inline-block;">
                              <a href="{{ URL::to('account/'.$usrAcc->id.'/edit') }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                              <a href="{{ URL::to('account/'.$usrAcc->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                              {{ Form::open(['route' => ['account.destroy', $usrAcc->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                              <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                              {{ Form::close() }}
                              </li>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
