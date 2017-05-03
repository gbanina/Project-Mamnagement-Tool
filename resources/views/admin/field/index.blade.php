@extends('base')

@section('content')
<div class="col-md-8 col-sm-8 col-xs-12 form-group">
    <div class="x_panel">
                  <div class="x_title">
                    <h2>Available Fields <small>Admin</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <a href="{{ URL::to('/admin/field/create') }}" class="btn btn-default">Add new Available Field</a>
                  <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 20%">Field Label</th>
                            <th style="width: 20%">Field Type</th>
                            <th style="width: 10%">Edit</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($fields as $field)
                          <tr>
                            <td>{{$field->id}}</td>
                            <td>
                              <a>{{$field->label}}</a>
                              <br>
                              <small>Created {{$field->created_at}}</small>
                            </td>
                            <td>
                              {{/*$typeSelect[$field->type]*/$field->type}}
                            </td>
                            <td>
                              <li style="display: inline-block;">
                                @if($field->predefined == 0)
                                  <a href="{{ URL::to('admin/field/'.$field->id.'/edit') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                  @component('component.delete-button', ['route' => 'field.destroy', 'id' => $field->id])
                                    Delete
                                  @endcomponent
                                @endif
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
@endsection
