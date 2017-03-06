<?php

namespace App\Http\Controllers\Front\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobOrder;

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
        // $jobOrder = jobOrder::with('joManpower.manpowerType.manpower')->where('job_order_no',$joNumber)->first();
        
        return view('hr.Department.poolingDetailView')
                ->with('jobOrder', $joNumber);
    }
}
