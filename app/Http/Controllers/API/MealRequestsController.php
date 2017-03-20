<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Meals\CreateMealRequest;
use App\Models\JobOrderMeal;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class MealRequestsController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $joId)
    {
        // user
        $user = $request->user();

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrderMeal::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderMeal::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_meals.job_order_id')
            ->join('meal_types', 'meal_types.id', '=', 'job_order_meals.meal_type_id')
            ->where('job_order_meals.job_order_id', '=', $joId)
            ->select('job_order_meals.*', 'job_orders.job_order_no', 'meal_types.name');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderMeal::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * @param CreateMealRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMealRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo) {
            $jo = JobOrderMeal::create($input);

            $jo = JobOrderMeal::where('id', $jo->id)->with('mealType', 'jobOrder')->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = JobOrderMeal::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}