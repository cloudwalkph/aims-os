<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreativesJo\CreateCreativesJoRequest;
use App\Models\Client;
use App\Models\CreativesJob;
use App\Models\CreativesJobAssignedPerson;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class CreativesOngoingController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = CreativesJob::orderBy($sortCol, $sortDir);
        } else {
            $query = CreativesJob::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'creatives_jobs.job_order_id')
            ->join('creatives_job_assigned_people', 'creatives_job_assigned_people.creatives_job_id', '=', 'creatives_jobs.id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'creatives_job_assigned_people.user_id')
            ->select('creatives_jobs.*', 'job_orders.project_name', 'job_orders.job_order_no',
                'user_profiles.first_name', 'user_profiles.last_name',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as assigned_person'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, CreativesJob::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * @param CreateCreativesJoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCreativesJoRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo) {
            $creative = CreativesJob::create($input);

            $data =[
                'user_id' => $input['user_id'],
                'creatives_job_id' => $creative->id
            ];

            $creative->assigned()->create(['user_id' => $input['user_id']]);

            $jo = CreativesJob::where('id', $creative->id)->with('assigned', 'jo')->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = CreativesJob::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}