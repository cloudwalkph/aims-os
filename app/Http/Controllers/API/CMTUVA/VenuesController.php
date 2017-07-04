<?php
namespace App\Http\Controllers\API\CMTUVA;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venues\CreateVenuesRequest;
use App\Models\JobOrderSelectedVenue;
use App\Models\Venue;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class VenuesController extends Controller
{
    use FilterTrait;

    public function all()
    {
        $venues = Venue::limit(20)->get();

        return response()->json($venues, 200);
    }

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
        $perPage = $request->has('per_page') ? (int)$request->get('per_page') : null;
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
        \DB::transaction(function () use ($input, &$venue) {
            $venue = Venue::create($input);

            $venue = Venue::where('id', $venue->id)->first();

        });

        return response()->json($venue, 201);
    }

    /**
     * @param CreateVenuesRequest $request
     * @param $venueId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateVenuesRequest $request, $venueId)
    {
        $input = $request->all();

        $venue = null;
        // Update venue
        \DB::transaction(function () use ($input, $venueId, &$venue) {
            $venue = Venue::where('id', $venueId)->update($input);
        });

        return response()->json($venue, 200);
    }

    /**
     * @param $venueId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($venueId)
    {
        $venue = Venue::where('id', $venueId)->delete();

        if (!$venue) {
            return response()->json([], 400);
        }

        return response()->json($venue, 200);
    }

    public function getSelectedVenues($jobOrderId)
    {
        $selectedVenues = JobOrderSelectedVenue::where('job_order_id', $jobOrderId)->get();

        $ids = [];
        foreach ($selectedVenues as $venue) {
            $ids[] = $venue->id;
        }

        $venues = Venue::whereIn('id', $ids)->get();

        return response()->json($venues, 200);
    }

    public function createSelectedVenues(Request $request, $jobOrderId)
    {
        if (! $request->has('selectedVenues')) {
            return response()->json(['bad request'], 400);
        }

        $result = [];
        foreach ($request->get('selectedVenues') as $venue) {
            $check = JobOrderSelectedVenue::where('job_order_id', $jobOrderId)
                ->where('venue_id', $venue['id'])
                ->first();

            if ($check) {
                continue;
            }

            $result[] = JobOrderSelectedVenue::create([
                'job_order_id'  => $jobOrderId,
                'venue_id'      => $venue['id']
            ]);
        }

        return response()->json($result, 201);
    }
}