<?php

namespace App\Http\Controllers\Front\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOrder;
use App\Models\ManpowerSchedules;
use App\Models\JobOrderSelectedManpower;
use App\Models\Venue;
use App\Models\JobOrderManpowerEvent;
use App\Models\JobOrderDetail;

class SetupController extends Controller
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
        config(['app.name' => 'Setup | AIMS']);

        return view('setup.index');
    }

    public function manpowerList() {
        config(['app.name' => 'Setup | AIMS']);

        return view('setup.Manpower.index');
    }

    public function getJoList() {
        config(['app.name' => 'Setup | AIMS']);

        return view('setup.Pooling.index');
    }

    public function viewJo($joId) {
        config(['app.name' => 'Setup | AIMS']);
        $jo = JobOrder::where('id',$joId)->first();
        
        return view('setup.Pooling.joDetailView')
                ->with('jo', $jo);
    }

    public function finalJo($joId) {
        config(['app.name' => 'Setup | AIMS']);
        $jo = JobOrder::where('id',$joId)->first();
        
        return view('setup.Final.index')
                ->with('jo', $jo);
    }

    public function previewFinalDeployment($joNumber) {
        config(['app.name' => 'Human Resources | AIMS']);
        
        $jo = JobOrder::where('job_order_no', $joNumber)->with('user.profile')->first();

        $data = [];
        $manpowerSched = ManpowerSchedules::where('job_order_id', $jo->id)->get();

        foreach($manpowerSched as $sched)
        {
            $venue = Venue::where('id',$sched->venue_id)->first();
            if(!$venue)
            {
                $venue = (object) ['venue' => 'TBA'];
            }
            if($sched->type == 'briefingSched')
            {
                $sched['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerAssignType.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$sched->venue_id)->get();
                $data['briefing'][$venue->venue][] = $sched;
                // $return['briefing'][$venue->venue]['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerType')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get(); 
                // $return['briefing'][$venue->venue]['schedule'] = $sched;
            }
        }
        // \Log::info($return['briefing']);
        return view('setup.Print.final_deployment', compact('jo','data'));
                // ->with('jo', $jo)
                // ->with('data', $data);
    }
}
