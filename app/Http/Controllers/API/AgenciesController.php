<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agencies\CreateAgencyRequest;
use App\Models\Agency;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class AgenciesController extends Controller {
    use FilterTrait;

    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = Agency::orderBy($sortCol, $sortDir);
        } else {
            $query = Agency::orderBy('id', 'asc');
        }

        $query->select('agencies.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, Agency::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $agencies = $query->paginate($perPage);

        return response()->json($agencies, 200);
    }

    /**
     * @param CreateAgencyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAgencyRequest $request)
    {
        $input = $request->all();

        $agency = null;
        // Create the agency
        \DB::transaction(function() use ($input, &$agency) {
            $name = strtolower($input['name']);
            $input['slug'] = str_replace(' ', '-', $name);

            $data = Agency::create($input);

            $agency = Agency::where('id', $data->id)->first();
        });

        return response()->json($agency, 201);
    }

    /**
     * @param CreateAgencyRequest $request
     * @param $agencyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateAgencyRequest $request, $agencyId)
    {
        $input = $request->all();

        $agency = null;
        // Update agency
        \DB::transaction(function() use ($input, $agencyId, &$agency) {
            $name = strtolower($input['name']);
            $input['slug'] = str_replace(' ', '-', $name);

            $agency = Agency::where('id', $agencyId)->update($input);
        });

        return response()->json($agency, 200);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($agencyId)
    {
        $user = Agency::where('id', $agencyId)->delete();

        if (! $user) {
            return response()->json([], 400);
        }

        return response()->json($user, 200);
    }

}