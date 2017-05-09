<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobOrders\CreateJobOrderProductRequest;
use App\Models\JobOrderProduct;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class JobOrderProductController extends Controller {
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
            $query = JobOrderProduct::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderProduct::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_products.job_order_id')
            ->where('job_order_products.job_order_id', '=', $joId)
            ->select('job_order_products.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderProduct::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $departments = $query->paginate($perPage);

        return response()->json($departments, 200);
    }

    public function store(CreateJobOrderProductRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo inventory
        \DB::transaction(function() use ($input, &$jo) {

            $jo = JobOrderProduct::create($input);

            $jo = JobOrderProduct::where('id', $jo->id)
                ->with('jobOrder')->first();
        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $jo = JobOrderProduct::where('id', $id)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}