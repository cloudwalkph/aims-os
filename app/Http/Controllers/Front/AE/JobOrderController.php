<?php

namespace App\Http\Controllers\Front\AE;

use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Models\JobOrderAnimationDetail;
use App\Models\JobOrderDetail;
use App\Models\JobOrderMom;
use Illuminate\Http\Request;

class JobOrderController extends Controller
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
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.jolist.index');
    }

    public function create()
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.jolist.create.create');
    }

    public function show($joNumber)
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();
        $mom = JobOrderMom::where('status', 'active')
            ->where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $detail = JobOrderDetail::where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $animations = JobOrderAnimationDetail::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
        }

        return view('ae.jolist.details.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('mom', $mom)
            ->with('detail', $detail)
            ->with('animations', $animations);
    }

    public function preview($joNumber)
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();
        $mom = JobOrderMom::where('status', 'active')
            ->where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $detail = JobOrderDetail::where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $animations = JobOrderAnimationDetail::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
        }
//        print_r($jo->user->profile); exit;
        return view('ae.jolist.details.print.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('mom', $mom)
            ->with('detail', $detail)
            ->with('animations', $animations);
    }

    public function saveJobOrderMOM(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;
        $mom = JobOrderMom::create($input);

        return redirect()->back();
    }

    public function saveEventDetails(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;
        $detail = JobOrderDetail::create($input);

        return redirect()->back();
    }

    public function saveAnimationDetails(Request $request, $joId)
    {
        $detail = null;
        \DB::transaction(function() use ($request, &$detail, $joId) {
            // Get all the input
            $input = $request->all();
            $input['job_order_id'] = $joId;

            // Create new jo animation details
            $detail = JobOrderAnimationDetail::create($input);
        });

        return redirect()->back();
    }
}