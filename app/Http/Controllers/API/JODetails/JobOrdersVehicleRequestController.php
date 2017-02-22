<?php
namespace App\Http\Controllers\JobOrders;

use App\Http\Controllers\Controller;
use App\Models\JobOrderVehicle;
use App\Traits\JobOrderTrait;
use Illuminate\Http\Request;

class JobOrdersVehicleRequestController extends Controller {

    use JobOrderTrait;

    public function getActive($jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $vehicle = JobOrderVehicle::where('job_order_id', $jobOrderId->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->with('vehicleType', 'venue', 'jobOrder', 'department')->get();

        return response()->json($vehicle, 200);
    }

    public function storeByJoId(Request $request, $jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        $user = $request->user()->toArray();
        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $vehicle = null;
        \DB::transaction(function() use ($request, &$vehicle, $jobOrderId, $user) {
            // Get all the input
            $input = $request->all();
            $input['job_order_id'] = $jobOrderId->id;
            $input['department_id'] = $user['department_id'];

            // Create new jo vehicle
            $vehicle = JobOrderVehicle::create($input);

            $vehicle = JobOrderVehicle::where('job_order_id', $jobOrderId->id)
                ->where('status', 'active')
                ->where('id', $vehicle->id)
                ->with('vehicleType', 'venue', 'jobOrder')->first();
        });

        if (! $vehicle) {
            return response()->json([], 400);
        }

        return response()->json($vehicle, 200);
    }
}