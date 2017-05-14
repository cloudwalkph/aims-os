<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderManpower;
use App\Models\JobOrderSelectedManpower;
use App\Models\ManpowerSchedules;
use App\Models\Venue;

class PoolingManpowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobOrder = JobOrder::with('joManpower.manpowerType')->paginate();
        return response()->json($jobOrder, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showJobOrderManpower($joNumber)
    {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();

        $joManpower = JobOrderManpower::with('manpowerType')->where('job_order_id', $jo->id)->paginate();
        return response()->json($joManpower, 200);
    }

    public function getSelectedManpower($joNumber) 
    {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();

        $joSelectedManpower = JobOrderSelectedManpower::with('jobOrder')
            ->with('venue')
            ->with('manpower.manpowerType')
            ->where('job_order_id', $jo->id)
            ->orderBy('id', 'ASC')
            ->get();

        return response()->json($joSelectedManpower, 200);
    }

    public function addSelectedManpower(Request $request, $joNumber)
    {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();
        
        $return = [];
        
        foreach($request['manpower'] as $manpower)
        {
            $data = [
                'job_order_id' => $jo->id,
                'manpower_id' => $manpower['id']
            ];
            if(isset($manpower['venue_id']))
            {
                $data['venue_id'] = $manpower['venue_id'];
            }

            
            $selectedManpower = JobOrderSelectedManpower::where('manpower_id',$data['manpower_id'])->first();
            
            if(!$selectedManpower)
            {
                $return[] = JobOrderSelectedManpower::create($data);
            }

        }
        return response()->json($return, 200);
    }

    public function deleteSelectedManpower($id)
    {
        $return = JobOrderSelectedManpower::where('id', $id)->delete();
        
        if(!$return)
        {
            return response()->json([], 400);
        }

        return response()->json($return, 200);
    }

    public function addManpowerSchedule(Request $request, $joNumber)
    {
        $input = $request->all();
        $date = date($input['date'].' '.$input['time']);
        $return = [];

        $jo = JobOrder::where('job_order_no',$joNumber)->first();

        $data = [
            'job_order_id' => $jo->id,
            'venue_id' => $input['venue_id'],
            'type' => $input['type'],
            'batch' => (isset($input['batch']) ? $input['batch'] : null),
            'created_datetime' => $date
        ];

        $return = ManpowerSchedules::create($data);

        return response()->json($return, 200);

    }

    public function getManpowerSchedule($joNumber)
    {
        $jo = JobOrder::where('job_order_no',$joNumber)->first();

        $return = ManpowerSchedules::where('job_order_id', $jo->id)->get();

        return response()->json($return, 200);
    }

    public function deteteManpowerSchedule($id)
    {
        $return = ManpowerSchedules::where('id', $id)->delete();
        
        if(!$return)
        {
            return response()->json([], 400);
        }

        return response()->json($return, 200);
    }

    public function manpowerDeployment($joNumber) {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();

        $return = [];
        $manpowerSched = ManpowerSchedules::where('job_order_id', $jo->id)->get();

        foreach($manpowerSched as $sched)
        {
            $venue = Venue::where('id',$sched->venue_id)->first();
            
            if($sched->type == 'briefingSched')
            {
                $return['briefing'][$venue->venue] = JobOrderSelectedManpower::with('manpower.manpowerType')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get(); 
            }

            if($sched->type == 'simulationSched')
            {
                $return['simulation'][$venue->venue] = JobOrderSelectedManpower::with('manpower.manpowerType')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get(); 
            }
        }

        return response()->json($return, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}