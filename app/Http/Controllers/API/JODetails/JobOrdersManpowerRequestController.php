<?php
namespace App\Http\Controllers\API\JODetails;

use App\Http\Controllers\Controller;
use App\Models\JobOrderManpower;
use App\Traits\JobOrderTrait;
use Illuminate\Http\Request;

class JobOrdersManpowerRequestController extends Controller {

    use JobOrderTrait;

    public function getActive($jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $manpower = JobOrderManpower::where('job_order_id', $jobOrderId->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->with('manpowerType')->get();

        return response()->json($manpower, 200);
    }

    public function store(Request $request, $jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $manpower = null;
        \DB::transaction(function() use ($request, &$manpower, $jobOrderId) {
            // Get all the input
            $input = $request->all();
            $input['job_order_id'] = $jobOrderId->id;

            // Create new jo mom
            $manpower = JobOrderManpower::create($input);

            $manpower = JobOrderManpower::where('job_order_id', $jobOrderId->id)
                ->where('id', $manpower->id)
                ->with('manpowerType')->first();
        });

        if (! $manpower) {
            return response()->json([], 400);
        }

        return response()->json($manpower, 200);
    }
}