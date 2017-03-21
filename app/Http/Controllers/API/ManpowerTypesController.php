<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManpowerType\CreateManpowerTypeRequest;
use App\Models\ManpowerType;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class ManpowerTypesController extends Controller {
    use FilterTrait;

    public function all()
    {
        $types = ManpowerType::all();

        return response()->json($types, 200);
    }

    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = ManpowerType::orderBy($sortCol, $sortDir);
        } else {
            $query = ManpowerType::orderBy('id', 'asc');
        }

        $query->select('manpower_types.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, ManpowerType::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $manpowerTypes = $query->paginate($perPage);

        return response()->json($manpowerTypes, 200);
    }

    /**
     * @param CreateManpowerTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateManpowerTypeRequest $request)
    {
        $input = $request->all();

        $type = null;
        // Create the manpower types
        \DB::transaction(function() use ($input, &$type) {
            $name = strtolower($input['name']);
            $input['slug'] = str_replace(' ', '-', $name);

            $data = ManpowerType::create($input);

            $type = ManpowerType::where('id', $data->id)->first();
        });

        return response()->json($type, 201);
    }

    /**
     * @param CreateManpowerTypeRequest $request
     * @param $manpowerTypeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateManpowerTypeRequest $request, $manpowerTypeId)
    {
        $input = $request->all();

        $manpowerType = null;
        // Update manpower type
        \DB::transaction(function() use ($input, $manpowerTypeId, &$manpowerType) {
            $name = strtolower($input['name']);
            $input['slug'] = str_replace(' ', '-', $name);

            $manpowerType = ManpowerType::where('id', $manpowerTypeId)->first();

            $manpowerType->update($input);
        });

        return response()->json($manpowerType, 200);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($typeId)
    {
        $type = ManpowerType::where('id', $typeId)->delete();

        if (! $type) {
            return response()->json([], 400);
        }

        return response()->json($type, 200);
    }

}