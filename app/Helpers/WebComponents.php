<?php

namespace App\Helpers;
use DateTime;
use App\Providers\Admin\TaskStatusServiceProvider;
use App\Providers\Admin\TaskTypeServiceProvider;
use App\Providers\Admin\ProjectTypeServiceProvider;
use Form;

class WebComponents{

    public static function status(){
        $service = new TaskStatusServiceProvider();
        $statuses = $service->all()->pluck('name', 'id')->prepend('Choose...', '');
        return Form::select('status_id', $statuses, '', array('id' => 'status_id', 'class' => 'form-control'));
    }
    public static function statusOverview(){
        $service = new TaskStatusServiceProvider();
        $statuses = $service->all()->pluck('name', 'name')->prepend('Choose...', '');
        return Form::select('status_id', $statuses, '', array('id' => 'status_id-filter', 'class' => 'form-control'));
    }
    public static function taskType(){
        $service = new TaskTypeServiceProvider();
        $types = $service->all()->pluck('name', 'id')->prepend('Choose...', '');
        return Form::select('type_id', $types, '', array('id' => 'type_id', 'class' => 'form-control'));
    }
    public static function taskTypeOverview(){
        $service = new TaskTypeServiceProvider();
        $types = $service->all()->pluck('name', 'name')->prepend('Choose...', '');
        return Form::select('type_id', $types, '', array('id' => 'type_id-filter', 'class' => 'form-control'));
    }
    public static function closedOverview(){
        $array = array('' => 'All', 'Yes' => 'Yes', 'No' => 'No');
        return Form::select('closed-filter', $array, '', array('id' => 'closed-filter', 'class' => 'form-control'));
    }
    public static function projectType(){
        $service = new ProjectTypeServiceProvider();
        $types =  $service->all()->pluck('label', 'label')->prepend('Project Type', '');
        return Form::select('type_id', $types, '', array('id' => 'type_id-filter', 'class' => 'form-control'));
    }
    public static function backUrl(){
        return \Session::get('real-previous-url');
    }
}
