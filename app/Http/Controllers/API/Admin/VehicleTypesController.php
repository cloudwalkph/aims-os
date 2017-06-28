<?php
namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleType\CreateVehicleTypeRequest;
use App\Models\VehicleType;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class VehicleTypesController extends Controller {

    use FilterTrait;

    public function all()
    {
        $types = VehicleType::all();

        return response()->json($types, 200);
    }

    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = VehicleType::orderBy($sortCol, $sortDir);
        } else {
            $query = VehicleType::orderBy('id', 'asc');
        }

        $query->select('vehicle_types.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, VehicleType::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $vehicleTypes = $query->paginate($perPage);

        return response()->json($vehicleTypes, 200);
    }

    /**
     * @param CreateVehicleTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateVehicleTypeRequest $request)
    {
        $input = $request->all();

        $type = null;
        // Create the vehicle types
        \DB::transaction(function() use ($input, &$type) {
            $name = strtolower($input['name']);
            $input['slug'] = str_replace(' ', '-', $name);

            $data = VehicleType::create($input);

            $type = VehicleType::where('id', $data->id)->first();
        });

        return response()->json($type, 201);
    }

    /**
     * @param CreateVehicleTypeRequest $request
     * @param $vehicleTypeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateVehicleTypeRequest $request, $vehicleTypeId)
    {
        $input = $request->all();

        $vehicleType = null;
        // Update manpower type
        \DB::transaction(function() use ($input, $vehicleTypeId, &$vehicleType) {
            $name = strtolower($input['name']);
            $input['slug'] = str_replace(' ', '-', $name);

            $vehicleType = VehicleType::where('id', $vehicleTypeId)->first();

            $vehicleType->update($input);
        });

        return response()->json($vehicleType, 200);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($typeId)
    {
        $type = VehicleType::where('id', $typeId)->delete();

        if (! $type) {
            return response()->json([], 400);
        }

        return response()->json($type, 200);
    }
}