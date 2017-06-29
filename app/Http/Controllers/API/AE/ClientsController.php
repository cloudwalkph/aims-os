<?php
namespace App\Http\Controllers\API\AE;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\CreateClientRequest;
use App\Models\Client;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class ClientsController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('all')) {
            if ($request->get('all')) {
                $allClients = Client::all();
                return response()->json($allClients->toArray(), 200);
            }
        }

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = Client::orderBy($sortCol, $sortDir);
        } else {
            $query = Client::orderBy('id', 'asc');
        }

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, Client::$filterable);
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
        return Client::find($clientId);
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
            $client = Client::create($input);
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
            $input['brands'] = json_encode($input['brands']);

            $client = Client::where('id', $clientId)->update($input);
        });

        return response()->json($client, 200);
    }

    /**
     * @param $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($clientId)
    {
        $client = Client::where('id', $clientId)->delete();

        if (! $client) {
            return response()->json([], 400);
        }

        return response()->json($client, 200);
    }
}