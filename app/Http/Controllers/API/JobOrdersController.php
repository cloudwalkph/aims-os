<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobOrders\CreateJobOrderRequest;
use App\Models\JobOrder;
use App\Models\JobOrderClient;
use App\Models\JobOrderDepartmentInvolved;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class JobOrdersController extends Controller {
    use FilterTrait;

    public function all()
    {
        $jos = JobOrder::all();

        return response()->json($jos, 200);
    }

    public function getByDepartmentInvolvement(Request $request)
    {
        $user = $request->user();
        $jos = JobOrderDepartmentInvolved::with('jobOrder')->where('department_id', $user['department_id'])
            ->get();

        $result = [];
        foreach ($jos as $jo) {
            $result[] = $jo->jobOrder;
        }

        return response()->json($result, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrder::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrder::orderBy('id', 'asc');
        }

        $query->join('job_order_clients', 'job_order_clients.job_order_id', '=', 'job_orders.id')
            ->join('clients', 'job_order_clients.client_id', '=', 'clients.id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'job_orders.user_id')
            ->groupBy('job_orders.id', 'user_profiles.last_name', 'user_profiles.first_name')
            ->select('job_orders.*', \DB::raw("GROUP_CONCAT(clients.`company` separator ', ') as company"),
                \DB::raw("GROUP_CONCAT(job_order_clients.`brands` separator ', ') as brands"),
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as created_by'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrder::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
\Log::info($query->toSql());
        // Get the data
        $jobOrders = $query->paginate($perPage);

        return response()->json($jobOrders, 200);
    }

    /**
     * @param $clientId
     * @return mixed
     */
    public function show($clientId)
    {
        return JobOrder::find($clientId);
    }

    /**
     * @param CreateJobOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateJobOrderRequest $request)
    {
        $user = $request->user();
        $input = $request->all();

        $jo = null;
        // Create the client
        \DB::transaction(function() use ($user, $input, &$jo) {
            $input['user_id'] = $user->id;
            $input['project_types'] = json_encode($input['project_types']);
            $input['job_order_no'] = strtoupper(uniqid());
            $clients = $input['clients'];
            unset($input['clients']);

            $jo = JobOrder::create($input);
            foreach ($clients as $client) {
                $clientData = [
                    'job_order_id'  => $jo->id,
                    'brands'        => json_encode($client['brands']),
                    'client_id'     => $client['id']
                ];

                JobOrderClient::create($clientData);
            }
        });

        return response()->json($jo, 201);
    }

    /**
     * @param CreateJobOrderRequest $request
     * @param $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateJobOrderRequest $request, $joId)
    {
        $input =$request->all();

        $jo = null;
        // Create the client
        \DB::transaction(function() use ($input, $joId, &$jo) {
            $jo = JobOrder::where('id', $joId)->update($input);
        });

        return response()->json($jo, 200);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = JobOrder::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}