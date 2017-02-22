<?php
namespace App\Http\Controllers\API\JODetails;

use App\Http\Controllers\Controller;
use App\Models\JobOrderDetail;
use App\Traits\JobOrderTrait;
use Illuminate\Http\Request;

class JobOrdersEventDetailsController extends Controller {

    use JobOrderTrait;

    public function getActive($jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $detail = JobOrderDetail::where('job_order_id', $jobOrderId->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')->first();

        return response()->json($detail, 200);
    }

    public function store(Request $request, $jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $detail = null;
        \DB::transaction(function() use ($request, &$detail, $jobOrderId) {
            // Get all the input
            $input = $request->all();
            $input['job_order_id'] = $jobOrderId->id;

            // Update old jo details status to revision
            JobOrderDetail::where('job_order_id', $jobOrderId->id)->update([
                'status' => 'revision'
            ]);

            // Create new jo details
            $detail = JobOrderDetail::create($input);
        });

        if (! $detail) {
            return response()->json([], 400);
        }

        return response()->json($detail, 200);
    }
}