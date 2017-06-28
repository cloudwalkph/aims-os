<?php
namespace App\Http\Controllers\API\JobOrders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manpowers\CreateManpowerRequest;
use App\Models\JobOrderManpower;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class ManpowerRequestsController extends Controller {
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
            $query = JobOrderManpower::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderManpower::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_manpowers.job_order_id')
            ->join('manpower_types', 'manpower_types.id', '=', 'job_order_manpowers.manpower_type_id')
            ->where('job_order_manpowers.job_order_id', '=', $joId)
            ->select('job_order_manpowers.*', 'job_orders.job_order_no', 'manpower_types.name');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderManpower::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * @param CreateManpowerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateManpowerRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo) {
            $jo = JobOrderManpower::create($input);

            $jo = JobOrderManpower::where('id', $jo->id)->with('manpowerType', 'jobOrder')->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = JobOrderManpower::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}