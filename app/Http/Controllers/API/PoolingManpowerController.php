<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderManpower;
use App\Models\JobOrderSelectedManpower;

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

        $joSelectedManpower = JobOrderSelectedManpower::with('jobOrder')->with('manpower.manpowerType')->where('job_order_id', $jo->id)->get();

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
                $return = JobOrderSelectedManpower::create($data);
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
