                    <br>
                    <h4>Users</h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($users as $usrAcc)
                        <tr>
                          <th scope="row">{{$usrAcc->user->id}}</th>
                          <td>{{$usrAcc->user->name}}</td>
                          <td>{{$usrAcc->user->email}}</td>
                          <td>{{$usrAcc->user->created_at}}</td>
                          <td>
                              {{ Form::open(['route' => ['task.destroy', $usrAcc->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                                <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                              {{ Form::close() }}
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
