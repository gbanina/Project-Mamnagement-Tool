<?php

namespace App\Http\Controllers\Project;

use DB;
use View;
use Auth;
use Redirect;
use Session;
use App\Models\ProjectPlan;
use App\Models\ProjectTypes;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Providers\ProjectServiceProvider;
use App\Providers\Project\PlanService;

class PlanController extends BaseController {

    protected $projectService;
    protected $planService;

    public function __construct()
    {
        $this->projectService = new ProjectServiceProvider(Auth::user());
        $this->planService = new PlanService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $plans = ProjectPlan::where('account_id', Auth::user()->current_acc);
        $view = View::make('project.plan.index')->with('plans', $plans->get());
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $fields = $this->projectService->fillCreate();
        return View::make('project.plan.create')->with('users',$fields['users'])
                    ->with('projectTypes',$fields['projectTypes']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($account, Request $request)
    {
        $name = Input::get('name');
        $responsibleId = Input::get('project_manager');
        $typeId = Input::get('project_type');
        $tomorrow_timestamp = strtotime("+ 1 day");
        $data = 'a:1:{s:4:"data";a:1:{i:0;a:10:{s:2:"id";s:1:"1";s:4:"text";s:'.strlen($name).':"'.$name.'";s:10:"start_date";s:16:"'. date('d-m-Y'). ' 00:00";s:8:"duration";s:1:"4";s:5:"order";s:2:"10";s:8:"progress";s:1:"1";s:4:"open";s:4:"true";s:8:"end_date";s:16:"'. date('d-m-Y', $tomorrow_timestamp). ' 00:00";s:6:"parent";s:1:"0";s:11:"responsible";s:'.strlen($responsibleId.'').':"'.$responsibleId.'";}}}';

        $plan = new ProjectPlan();
        $plan->account_id = Auth::user()->current_acc;
        $plan->user_id = $responsibleId;
        $plan->project_type_id = $typeId;
        $plan->name = $name;

        $plan->plan = $data;
        $plan->save();


        $request->session()->flash('alert-success', 'ProjectPlan : '.$name.' was successful created!');
        return Redirect::to($account . '/project-plan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($account, $id)
    {
        $plan = ProjectPlan::find($id);
        $projectType = ProjectTypes::find($plan->project_type_id);
        $taskTypes = $projectType->posibleTaskTypes()->pluck('name', 'id')->prepend('Choose type', '');
        return View::make('project.plan.edit')->with('plan', $plan)
                ->with('taskTypes', $taskTypes)->with('planJson', json_encode(unserialize($plan->plan)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($account, $id, Request $request)
    {
        $plan = ProjectPlan::find($id);
        $plan->plan = serialize(Input::get('data'));

        $plan->update();

        return "plan saved";
    }
    public function run($account, $id, Request $request) {
        $project = $this->planService->run($id);
        $request->session()->flash('alert-success', 'Successfuly created project from plan : '.$project->name.'!');
        return Redirect::to($account . '/project-plan');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($account, $id, Request $request)
    {
        $plan = ProjectPlan::find($id);
        $plan->delete();
        $request->session()->flash('alert-success', 'Project Plan was successfuly deleted!');
        return Redirect::to($account . '/project-plan');
    }

}
