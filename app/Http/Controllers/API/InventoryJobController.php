<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Inventory\InventoryJobRequest;

use App\Models\InventoryJob;

use App\Traits\FilterTrait;

use DB;

class InventoryJobController extends Controller
{
    use FilterTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // user
        $user = $request->user();

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = InventoryJob::orderBy($sortCol, $sortDir);
        } else {
            $query = InventoryJob::orderBy('id', 'asc');
        }

        $query->leftJoin('job_orders', 'job_orders.id', '=', 'inventory_jobs.job_order_id')
            ->leftJoin('inventory_job_assigned_people', 'inventory_job_assigned_people.inventory_job_id', '=', 'inventory_jobs.id')
            ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'inventory_job_assigned_people.user_id')
            ->select(
                'inventory_jobs.*',
                'job_orders.project_name', 'job_orders.job_order_no',
                'inventory_job_assigned_people.user_id',
                'user_profiles.first_name', 'user_profiles.last_name',
                DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as assigned_person')
            );

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, InventoryJob::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;

        // Get the data
        $jos = $query->where('user_profiles.user_id', $user['id'])->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventoryJobRequest $request)
    {
        $input = $request->all();
        $input['deadline'] = date('Y-m-d H:i:s', strtotime($input['deadline']));

        $jo = null;
        // Create the jo
        DB::transaction(function() use ($input, &$jo) {
            $inventory = InventoryJob::create($input);

            $data =[
                'user_id' => $input['user_id']
            ];

            $inventory->assignedPerson()->create($data);

            $jo = InventoryJob::where('id', $inventory->id)->with('jobOrders', 'assignedPerson')->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return InventoryJob::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InventoryJobRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jo = InventoryJob::where('id', $id)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}
