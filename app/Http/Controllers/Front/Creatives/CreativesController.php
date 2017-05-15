<?php

namespace App\Http\Controllers\Front\Creatives;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\CreativesJob;
use App\Models\CreativesTask;
use App\Models\CreativesTasks;
use App\Models\JobOrderDepartmentInvolved;
use Illuminate\Http\Request;

class CreativesController extends Controller
{
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

    public function ongoing()
    {
        config(['app.name' => 'Creatives On-Going Projects | AIMS']);

        return view('creatives.ongoing.index');
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

        $request->session()->flash('success', 'Posted task successfully');
        return redirect()->back();
    }
}
