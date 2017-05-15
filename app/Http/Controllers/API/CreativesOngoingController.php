<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreativesJo\CreateCreativesJoRequest;
use App\Models\Assignment;
use App\Models\CreativesJob;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class CreativesOngoingController extends Controller {
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
            $query = Assignment::orderBy($sortCol, $sortDir);
        } else {
            $query = Assignment::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'assignments.job_order_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'assignments.user_id')
            ->select('assignments.*', 'job_orders.project_name', 'job_orders.job_order_no',
                'user_profiles.first_name', 'user_profiles.last_name',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as assigned_person'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, Assignment::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $jos = $query->where('assignments.department_id', 2)->paginate($perPage);

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
            $creative = Assignment::create([
                'job_order_id' => $input['job_order_id'],
                'user_id'      => $input['user_id'],
                'department_id' => 2,
                'deadline'      => $input['deadline'],
                'remarks'       => $input['description']
            ]);

//            $creative = CreativesJob::create($input);

//            $data =[
//                'user_id' => $input['user_id'],
//                'creatives_job_id' => $creative->id
//            ];
//
//            $creative->assigned()->create(['user_id' => $input['user_id']]);

//            $jo = CreativesJob::where('id', $creative->id)->with('assigned', 'jo')->first();

            $jo = Assignment::with('jobOrder', 'assignedUser')->where('id', $creative->id)->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($assignmentId)
    {
        $jo = Assignment::where('id', $assignmentId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}