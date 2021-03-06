<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderManpower;
use App\Models\JobOrderSelectedManpower;
use App\Models\ManpowerSchedules;
use App\Models\Venue;
use App\Models\JobOrderManpowerEvent;
use Carbon\Carbon;

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

        $joManpower = JobOrderManpower::with('manpowerType')->where('job_order_id', $jo->id)->get();
        
        foreach($joManpower as $joMan)
        {
            $joMan['selected_count'] = JobOrderSelectedManpower::where('job_order_id', $jo->id)->where('manpower_type_required',$joMan->manpower_type_id)->count();
            
        }
        // \Log::info($joManpower);
        return response()->json($joManpower, 200);
    }

    public function getSelectedManpower($joNumber) 
    {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();
        $return = [];
        $joSelectedManpower = JobOrderSelectedManpower::with('jobOrder')
            ->with('venue')
            ->with('manpower.manpowerAssignType.manpowerType')
            ->where('job_order_id', $jo->id)
            ->orderBy('manpower_type_required', 'ASC')
            ->get();
        if($joSelectedManpower)
        {
            foreach($joSelectedManpower as $key=>$selected)
            {
               $selected['manpower']['venue_id'] = $selected['venue_id']; 
               $selected['manpower']['buffer'] = $selected['buffer']; 
               $selected['manpower']['manpower_type_required'] = $selected['manpower_type_required']; 
               $return[] = $selected['manpower'];
            }
        }
        return response()->json($return, 200);
    }

    public function addSelectedManpower(Request $request, $joNumber)
    {
        $jo = JobOrder::where('job_order_no', $joNumber)->first();
        
        $return = [];
        
        foreach($request['manpower'] as $manpower)
        {
            $data = [
                'job_order_id' => $jo->id,
                'manpower_id' => $manpower['id'],
                'manpower_type_required' => $manpower['manpower_type_required'],
                'venue_id' => 0
            ];
            // return $data;
            if(isset($manpower['venue_id']))
            {
                $data['venue_id'] = $manpower['venue_id'];
            }

            
            $selectedManpower = JobOrderSelectedManpower::where('manpower_id',$data['manpower_id'])->where('job_order_id',$jo->id)->first();
            
            if(!$selectedManpower)
            {
                $joManpower = JobOrderManpower::where('job_order_id',$jo->id)->where('manpower_type_id',$manpower['manpower_type_required'])->first();
                
                if($joManpower)
                {
                    $manpowerNeeded = JobOrderSelectedManpower::where('job_order_id', $jo->id)->where('manpower_type_required',$manpower['manpower_type_required'])->get();
                    if($joManpower->manpower_needed <= count($manpowerNeeded))
                    {
                        $data['buffer'] = 1;
                    }
                }
                
                $query = JobOrderSelectedManpower::create($data);
                $return[] = $query;
            }else
            {
                $return[] = JobOrderSelectedManpower::where('manpower_id',$data['manpower_id'])->where('job_order_id',$jo->id)->update($data);
            }

        }
        return response()->json($return, 200);
    }

    public function deleteSelectedManpower($id,$joId)
    {
        $return = JobOrderSelectedManpower::where('manpower_id', $id)->where('job_order_id',$joId)->delete();
        
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
            'venue_id' => $input['venue_id'] ? $input['venue_id'] : 0,
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

        foreach($manpowerSched as $key=>$sched)
        {
            $venue = Venue::where('id',$sched->venue_id)->first();
            if(!$venue)
            {
                $venue = (object) ['venue' => 'TBA'];
            }
            if($sched->type == 'briefingSched')
            {
                $sched['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerAssignType.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$sched->venue_id)->get();
                $return['briefing'][$venue->venue][] = $sched;
                // $return['briefing'][$key]['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get();
                // $return['briefing'][$key]['manpower_list']['schedule'] = $sched;
            }

            if($sched->type == 'simulationSched')
            {
                $sched['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerAssignType.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$sched->venue_id)->get();
                $return['simulation'][$venue->venue][] = $sched;
                // $return['simulation'][]['manpower_list'] = JobOrderSelectedManpower::with('manpower.manpowerType')->with('venue')->where('job_order_id', $jo->id)->where('venue_id',$venue->id)->get(); 
                // $return['simulation'][]['manpower_list']['schedule'] = $sched;
            }
        }

        return response()->json($return, 200);
    }

    public function setEventManpower(Request $request, $joId) {
        $input = $request->all();
        $input['event_date'] = Carbon::parse($input['event_date'])->toDateTimeString();
        $return = [];
        
        $query = JobOrderManpowerEvent::where('job_order_id', $joId)->first();
        
        if($query)
        {
            $return[] = JobOrderManpowerEvent::where('job_order_id', $joId)->update($input);
            return response()->json($return, 200);
        }

        $return[] = JobOrderManpowerEvent::create($input);
        return response()->json($return, 200);
    }

    public function assignBufferManpower(Request $request, $joId) {
        $input = $request->all();
        // return $input;
        if($input['start']['buffer'] == 0)
        {
            $dataStart = [
                'buffer' => 1
            ]; 
        }else
        {
            $dataStart = [
                'buffer' => 0
            ];
        }

        if($input['end']['buffer'] == 0)
        {
            $dataEnd = [
                'buffer' => 1
            ]; 
        }else
        {
            $dataEnd = [
                'buffer' => 0
            ];
        }
        
        JobOrderSelectedManpower::where('job_order_id', $joId)->where('manpower_id', $input['start']['id'])->update($dataStart); 
        JobOrderSelectedManpower::where('job_order_id', $joId)->where('manpower_id', $input['end']['id'])->update($dataEnd); 

        return response()->json(['ok'], 200);
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