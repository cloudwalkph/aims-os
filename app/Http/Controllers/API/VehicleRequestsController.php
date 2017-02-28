<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicles\CreateVehicleRequest;
use App\Models\JobOrderVehicle;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class VehicleRequestsController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // user
        $user = $request->user();

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrderVehicle::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderVehicle::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_vehicles.job_order_id')
            ->join('vehicle_types', 'vehicle_types.id', '=', 'job_order_vehicles.vehicle_type_id')
            ->join('venues', 'venues.id', '=', 'job_order_vehicles.venue_id')
            ->select('job_order_vehicles.*', 'job_orders.job_order_no', 'vehicle_types.name', 'venues.venue');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderVehicle::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * @param CreateVehicleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateVehicleRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo) {
            $jo = JobOrderVehicle::create($input);

            $jo = JobOrderVehicle::where('id', $jo->id)->with('vehicleType', 'jobOrder')->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = JobOrderVehicle::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}