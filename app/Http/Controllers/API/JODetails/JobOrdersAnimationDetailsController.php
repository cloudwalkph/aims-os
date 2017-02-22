<?php
namespace App\Http\Controllers\JobOrders;

use App\Http\Controllers\Controller;
use App\Models\JobOrderAnimationDetail;
use App\Traits\JobOrderTrait;
use Illuminate\Http\Request;

class JobOrdersAnimationDetailsController extends Controller {

    use JobOrderTrait;

    public function getActive($jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $detail = JobOrderAnimationDetail::where('job_order_id', $jobOrderId->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')->get();

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

            // Create new jo animation details
            $detail = JobOrderAnimationDetail::create($input);

            $detail = JobOrderAnimationDetail::where('job_order_id', $jobOrderId->id)
                ->where('id', $detail->id)->first();
        });

        if (! $detail) {
            return response()->json([], 400);
        }

        return response()->json($detail, 200);
    }
}