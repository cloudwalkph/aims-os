<?php
namespace App\Http\Controllers\API\JODetails;

use App\Http\Controllers\Controller;
use App\Models\JobOrderMeal;
use App\Traits\JobOrderTrait;
use Illuminate\Http\Request;

class JobOrdersMealRequestController extends Controller {

    use JobOrderTrait;

    public function getActive($jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $meal = JobOrderMeal::where('job_order_id', $jobOrderId->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->with('mealType')->get();

        return response()->json($meal, 200);
    }

    public function store(Request $request, $jobOrderNo)
    {
        $jobOrderId = $this->getJobOrderIdByNumber($jobOrderNo);

        if (! $jobOrderId) {
            return response()->json([], 400);
        }

        $meal = null;
        \DB::transaction(function() use ($request, &$meal, $jobOrderId) {
            // Get all the input
            $input = $request->all();
            $input['job_order_id'] = $jobOrderId->id;

            // Create new jo meal
            $meal = JobOrderMeal::create($input);

            $meal = JobOrderMeal::where('job_order_id', $jobOrderId->id)
                ->where('id', $meal->id)
                ->with('mealType')->first();
        });

        if (! $meal) {
            return response()->json([], 400);
        }

        return response()->json($meal, 200);
    }
}