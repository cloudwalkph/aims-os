<?php

namespace App\Http\Controllers\Front\Creatives;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreativesJo\CreateCreativesJoRequest;
use App\Models\Assignment;
use App\Models\CreativesJob;
use App\Models\CreativesTask;
use App\Models\CreativesTasks;
use App\Models\JobOrderDepartmentInvolved;
use App\Traits\NotificationTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreativesController extends Controller
{
    use NotificationTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        config(['app.name' => 'Creatives | AIMS']);

        $user = \Auth::user();
        $jos = JobOrderDepartmentInvolved::with('jobOrder.user.profile')
            ->where('department_id', $user->department_id)
            ->get();

        return view('creatives.index')
            ->with('jos', $jos->toArray());
    }

    public function schedules()
    {
        config(['app.name' => 'Creatives Schedules | AIMS']);

        return view('creatives.schedules');
    }

    public function ongoing(Request $request)
    {
        config(['app.name' => 'Creatives On-Going Projects | AIMS']);

        $projects = JobOrderDepartmentInvolved::with('jobOrder')->where('department_id', 2)
            ->get();

        $result = [];
        $assignedCount = 0;

        foreach ($projects as $project) {
            $assigned = Assignment::where('job_order_id', $project->job_order_id)
                ->where('department_id', 2)->first();

            $person = 'N/A';
            if ($assigned) {
                $person = $assigned->assignedUser->profile->full_name;
                $assignedCount = $assignedCount + 1;
            }

            if ($request->has('type') && $request->get('type') === 'assigned') {
                if ($assigned) {
                    $result[] = [
                        'job_order_id'  => $project->job_order_id,
                        'job_order_no'  => $project->jobOrder->job_order_no,
                        'project_name'  => $project->jobOrder->project_name,
                        'description'   => $project->deliverables,
                        'deadline'      => Carbon::createFromTimestamp(strtotime($project->deadline))->toFormattedDateString(),
                        'assigned_persons'  => $person
                    ];
                }
            } else if ($request->has('type') && $request->get('type') === 'unassigned') {
                if (! $assigned) {
                    $result[] = [
                        'job_order_id'  => $project->job_order_id,
                        'job_order_no'  => $project->jobOrder->job_order_no,
                        'project_name'  => $project->jobOrder->project_name,
                        'description'   => $project->deliverables,
                        'deadline'      => Carbon::createFromTimestamp(strtotime($project->deadline))->toFormattedDateString(),
                        'assigned_persons'  => $person
                    ];
                }
            } else {
                $result[] = [
                    'job_order_id'  => $project->job_order_id,
                    'job_order_no'  => $project->jobOrder->job_order_no,
                    'project_name'  => $project->jobOrder->project_name,
                    'description'   => $project->deliverables,
                    'deadline'      => Carbon::createFromTimestamp(strtotime($project->deadline))->toFormattedDateString(),
                    'assigned_persons'  => $person
                ];
            }
        }

        $members = User::with('profile')->where('department_id', 2)->get();

        $totalCount = count($projects);

        $projects = $result;

        return view('components.projects.index', compact('projects', 'assignedCount', 'totalCount', 'members'));
    }

    public function assignProject(CreateCreativesJoRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo, $request) {
            $creative = Assignment::create([
                'job_order_id' => $input['job_order_id'],
                'user_id'      => $input['user_id'],
                'department_id' => 2,
                'deadline'      => Carbon::createFromTimestamp(strtotime($input['deadline']))->toDateTimeString(),
                'remarks'       => $input['description']
            ]);

            $jo = Assignment::with('jobOrder', 'assignedUser')->where('id', $creative->id)->first();

            $this->assignmentUpdated($input['job_order_id'], $request->user());
        });

        if (! $jo) {
            $request->session()->flash('error', 'Failed in assigning jo');
            return redirect()->back();
        }

        $request->session()->flash('success', 'Failed in assigning jo');

        return redirect()->back();
    }

    public function workInProgress()
    {
        config(['app.name' => 'Creatives Work in Progress | AIMS']);

        return view('creatives.work-in-progress.index');
    }

    public function workDetails($id, $joId)
    {
        config(['app.name' => 'Creatives Work in Progress Details | AIMS']);

        $jo = Assignment::with('jobOrder', 'assignedUser.profile', 'tasks')
            ->where('id', $id)
            ->where('job_order_id', $joId)
            ->first();

        return view('creatives.work-in-progress.details')->with('jo', $jo);
    }

    public function addTask(Request $request, $id, $joId)
    {
        $user = $request->user();
        $input = $request->all();
        
        $filename = '';
        if ($request->hasFile('file')) {
            $filename = uniqid() . '.png';

            $request->file('file')->storeAs('creatives', $filename);
        }

        $task = CreativesTask::create([
            'assignment_id' => $id,
            'user_id'       => $user->id,
            'message'       => $input['message'],
            'file'          => $filename,
            'is_final'      => isset($input['is_final']) ? $input['is_final'] : 0
        ]);

        if (! $task) {
            $request->session()->flash('error', 'Failed in posting a task');
            return redirect()->back();
        }

        $this->assignmentUpdated($joId, $request->user());

        $request->session()->flash('success', 'Posted task successfully');
        return redirect()->back();
    }
}
