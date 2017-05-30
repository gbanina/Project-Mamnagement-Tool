@extends('base')

@section('content')
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Available Fields</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{ URL::to('/admin/field/create') }}" class="btn btn-default">Add new Available Field</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;">
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th style="width: 120px">Type</th>
                            <th style="width: 70px"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($fields as $field)
                          <tr>
                            <td>
                              <a href="{{ URL::to('admin/field/'.$field->id.'/edit') }}">{{$field->label}}</a>
                              <br>
                              <small>Created {{$field->created_at}}</small>
                            </td>
                            <td>
                              {{/*$typeSelect[$field->type]*/$field->type}}
                            </td>
                            <td>
                              <li style="display: inline-block;">
                                @if($field->predefined == 0)
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
              </div>
@endsection
