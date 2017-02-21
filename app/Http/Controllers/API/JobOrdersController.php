<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class JobOrdersController extends Controller {
    use FilterTrait;
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
            ->select('job_orders.*', 'clients.company', 'job_order_clients.brands',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as created_by'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrder::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;

        // Get the data
        $clients = $query->paginate($perPage);

        return response()->json($clients, 200);
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
     * @param CreateClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateClientRequest $request)
    {
        $user = $request->user();
        $input = $request->all();

        $client = null;
        // Create the client
        \DB::transaction(function() use ($user, $input, &$client) {
            $input['user_id'] = $user->id;
            $input['brands'] = json_encode($input['brands']);
            $client = JobOrder::create($input);
        });

        return response()->json($client, 201);
    }

    /**
     * @param CreateClientRequest $request
     * @param $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateClientRequest $request, $clientId)
    {
        $input =$request->all();

        $client = null;
        // Create the client
        \DB::transaction(function() use ($input, $clientId, &$client) {
            $client = JobOrder::where('id', $clientId)->update($input);
        });

        return response()->json($client, 200);
    }

    /**
     * @param $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($clientId)
    {
        $client = JobOrder::where('id', $clientId)->delete();

        if (! $client) {
            return response()->json([], 400);
        }

        return response()->json($client, 200);
    }
}