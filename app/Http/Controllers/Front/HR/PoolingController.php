<?php

namespace App\Http\Controllers\Front\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\ManpowerSchedules;
use App\Models\JobOrderSelectedManpower;
use App\Models\Venue;
use App\Models\JobOrderManpowerEvent;

class PoolingController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        config(['app.name' => 'Human Resources | AIMS']);

        return view('hr.Department.pooling');
    }

    public function show($joNumber)
    {
        $jobOrder = jobOrder::with('joManpower.manpowerType.manpower')->where('job_order_no',$joNumber)->first();
        $joEvent = JobOrderManpowerEvent::where('job_order_id',$jobOrder->id)->first();

        return view('hr.Department.poolingDetailView')
                ->with('jobOrder', $joNumber)
                ->with('joId', $jobOrder->id)
                ->with('joEvent', $joEvent);
    }

    public function previewFinalDeployment($joNumber) {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();

        $return = [];
        $manpowerSched = ManpowerSchedules::where('job_order_id', $jo->id)->get();

        foreach($manpowerSched as $sched)
        {
            $venue = Venue::where('id',$sched->venue_id)->first();
            
            if($sched->type == 'briefingSched')
            {
                $sched['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerAssignType.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$sched->venue_id)->get();
                $return['briefing'][$venue->venue][] = $sched;
                // $return['briefing'][$venue->venue]['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerType')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get(); 
                // $return['briefing'][$venue->venue]['schedule'] = $sched;
            }

            if($sched->type == 'simulationSched')
            {
                $sched['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerAssignType.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$sched->venue_id)->get();
                $return['simulation'][$venue->venue][] = $sched;
                // $return['simulation'][$venue->venue]['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerType')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get(); 
                // $return['simulation'][$venue->venue]['schedule'] = $sched;
            }
        }
        // \Log::info($return['briefing']);
        return view('hr.print.finalDeployment')
                ->with('jo', $jo)
                ->with('data', $return);
    }
}
