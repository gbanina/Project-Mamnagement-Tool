<?php

namespace App\Providers;

use Auth;
use App\Models\Role;
use App\Models\Project;
use App\Models\ProjectRight;
use App\Models\FieldRight;
use Illuminate\Support\ServiceProvider;

class ProjectRightProvider extends ServiceProvider
{
    public function __construct()
    { }

    public function all(){
        $result['roles'] = Role::where('account_id', Auth::user()->current_acc)->get();
        $projects = $this->getProjects();

        $projectRights = array();
        $fieldRights = array();

        foreach($projects as $project){
            $projectRights[$project->id] = $this->getProjectRights($project->id);
            $fieldRights[$project->id] = $this->getFieldRights($project->id);
        }
        $result['projects'] = $projects;
        $result['viewStyle'] = ' min-width: ' . count($result['roles']) * 216 . 'px';
        $result['projectRights'] = $projectRights;
        $result['fieldRights'] = $fieldRights;

        return $result;
    }

    public function storeAll($project_right, $field_right){
        foreach ($this->getProjects() as $project) {
            $this->storeProjectRights($project->id, $project_right[$project->id]);
            $this->storeFieldRights($project->id, $field_right[$project->id]);
        }
    }

    public function getProjects()
    {
        return Project::where('account_id', Auth::user()->current_acc)->get();
    }

    public function projectRightsIndex($id)
    {
        $result = array();

        $result['project'] = Project::find($id);
        $result['roles'] = Role::where('account_id', Auth::user()->current_acc)->get();
        $result['projectRights'][$id] = $this->getProjectRights($id);
        $result['fieldRights'][$id] = $this->getFieldRights($id);
        $result['viewStyle'] = ' min-width: ' . count($result['roles']) * 216 . 'px';

        return $result;
    }
    public function projectRightsStore($id, $args)
    {
        $this->storeProjectRights($id, $args['project_right'][$id]);
        $this->storeFieldRights($id, $args['field_right'][$id]);
    }

    public function getFieldRights($projectId)
    {
        $result = array();
        $roles = Role::where('account_id', Auth::user()->current_acc)->get();
        foreach($roles as $role) {
            $roles = FieldRight::where('role_id', $role->id)->where('project_id', $projectId)->get();
            foreach ($roles as $fieldRightId => $fieldRight) {
                $result[$role->id][$fieldRight->task_type_id][$fieldRight->task_field_id] = $fieldRight->permission;
            }
        }

        return $result;
    }
    public function getProjectRights($projectId)
    {
        $result = array();
        $roles = Role::where('account_id', Auth::user()->current_acc)->get();
        foreach($roles as $role) {
            $result[$role->id] = ProjectRight::where('role_id', $role->id)->where('project_id', $projectId)->pluck('permission')->first();
        }
        return $result;
    }
    public function storeProjectRights($projectId, $args)
    {
        \DB::table('project_rights')->where('project_id', $projectId)->delete();
        if($args != null) {
            foreach($args as $roleId=>$permission){
            $rightObj = ProjectRight::create(['role_id' => $roleId,
                            'project_id' => $projectId, 'permission' => $permission]);
            }
        }
    }
    public function storeFieldRights($projectId, $args)
    {
        \DB::table('field_rights')->where('project_id', $projectId)->delete();
        if($args != null) {
            foreach($args as $roleId=>$roleObj){
                foreach($roleObj as $taskTypeId=>$typeObj){
                    foreach($typeObj as $fieldId=>$permission){
                        FieldRight::create(['role_id' => $roleId, 'project_id' => $projectId,
                            'task_type_id' => $taskTypeId, 'task_field_id' => $fieldId, 'permission' => $permission]);
                    }
                }
            }
        }
    }
}
