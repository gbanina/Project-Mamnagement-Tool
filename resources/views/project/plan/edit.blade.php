@extends('base')

@section('content')
{!! Form::model($plan, array('project-plan', 'method' => 'PUT', 'class' => 'form-horizontal exit-alert form-label-left')) !!}
            <meta name="csrf-token" content="{{ csrf_token() }}">
{!! Form::close() !!}

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
                  <div class="x_title">
                    <h2>Project Plan - {{$plan->name}}</h2>
                    <div class="header-buttons">
                        <a href="{{ TMBS::url('project-plan/run/'.$plan->id) }}" class="btn btn-sm btn-success">Run</a>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                        <a href="{{ WebComponents::backUrl() }}" class="btn btn-default" type="button">Cancel</a>
                        <a onClick="save_plan()" class="btn btn-primary">Save</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block;height: 650px">
                    <div id="gantt_here" style='width:100%; height:100%;'></div>
                  </div>
                  </div>
                </div>
              </div>

                  <script type="text/javascript">

        var plan = {!! ($planJson) !!};
        //default columns definition
        gantt.config.columns = [
            {name:"text",       label:"Task name",  width:"*", tree:true },
            {name:"duration",   label:"Duration",   align: "center" },
            {name:"responsible",   label:"Responsible",  template:function(obj){
                return gantt.getLabel("responsible", obj.responsible);
            }, align: "center", width:60 },
            {name:"task_types",   label:"Task Types",  template:function(obj){
                return gantt.getLabel("task_types", obj.task_types);
            }, align: "center", width:60 },
            {name:"add",        label:"",           width:100 }
        ];
                gantt.locale.labels["section_responsible"] = "Responsible";
                gantt.locale.labels["section_task_types"] = "Task Type";
                gantt.locale.labels["section_name"] = "Task Name";
        gantt.config.lightbox.sections = [
            {name: "name", height: 38, map_to: "text", type: "textarea", focus: true},
            {name: "responsible", height: 30, map_to: "responsible", type: "select", options: [
                @foreach(WebComponents::users() as $id=>$user)
                    {key:"{{$id}}", label: "{{$user}}"},
                @endforeach
                ]},
            {name: "task_types", height: 30, map_to: "task_types", type: "select", options: [
                @foreach($taskTypes as $id=>$type)
                    {key:"{{$id}}", label: "{{$type}}"},
                @endforeach
                ]},
            {name: "time", type: "duration", map_to: "auto", time_format:["%d","%m","%Y"]}
        ];
        gantt.init("gantt_here");


        gantt.parse(plan);


function save_plan() {

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "PUT",
            url: "{{ TMBS::url('project-plan/'. $plan->id)}}",
            data: {data: gantt.serialize() },
            success: function( msg ) {
                  new PNotify({
                    title: 'Project Plan saved!',
                    text: msg,
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }
        });
}

    </script>

@endsection






