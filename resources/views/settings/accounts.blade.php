                  <div class="x_content" style="display: block;">
                      <h2>My Accounts</h2>
                      <table id="advanced-table" class="table table-striped projects">
                        <thead>
                          <tr>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Role</th>
                          <th>Created</th>
                          <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($accounts as $usrAcc)
                          <tr>
                          <td>{{$usrAcc->account->name}}</td>
                          <td>{{$usrAcc->type}}</td>
                          <td>{{$usrAcc->role->name}}</td>
                          <td>{{$usrAcc->user->created_at}}</td>
                            <td>
                              <li style="display: inline-block;">
                              {{ Form::open(['route' => ['account.destroy', $usrAcc->id], 'method' => 'delete', 'style'=>'display: inline']) }}
                              <button type="submit" class="btn btn-danger btn-xs">Leave</button>
                              {{ Form::close() }}
                              </li>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
