@extends('base')

@section('content')
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Type</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ TMBS::url('admin/project-type/create') }}" class="btn btn-default">Add new Project Type</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th>Type Name</th>
                            <th style="width: 100px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($projectTypes as $type)
                          <tr>
                            <td>
                              <a href="{{ TMBS::url('admin/project-type/'.$type->id.'/edit') }}">{{$type->label}}</a>
                              <br>
                              <small>Created {{$type->created_at}}</small>
                            </td>
                            <td>
                              <li style="display: inline-block;">
                               @component('component.delete-button', ['url' => 'admin/project-type', 'id' => $type->id])
                                  Delete
                                @endcomponent
                              </li>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- end project list -->
                  </div>
                </div>
              </div>
@endsection
