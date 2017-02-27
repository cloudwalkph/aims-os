<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venues\CreateVenuesRequest;
use App\Models\Venue;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class VenuesController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = Venue::orderBy($sortCol, $sortDir);
        } else {
            $query = Venue::orderBy('id', 'asc');
        }

        $query->select('venues.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, Venue::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $venues = $query->paginate($perPage);

        return response()->json($venues, 200);
    }

    /**
     * @param CreateVenuesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateVenuesRequest $request)
    {
        $input = $request->all();

        $venue = null;
        // Create the venue
        \DB::transaction(function() use ($input, &$venue) {
            $venue = Venue::create($input);

            $venue = Venue::where('id', $venue->id)->first();

        });

        return response()->json($venue, 201);
    }

    /**
     * @param $venueId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($venueId)
    {
        $venue = Venue::where('id', $venueId)->delete();

        if (! $venue) {
            return response()->json([], 400);
        }

        return response()->json($venue, 200);
    }
}