<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Inventory\InventoryJobRequest;

use App\Models\Assignment;
use App\Models\InventoryJob;
use App\Models\InventoryJobAssignedPerson;
use App\Models\JobOrderDepartmentInvolved;

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
            $query = Assignment::orderBy($sortCol, $sortDir);
        } else {
            $query = Assignment::orderBy('id', 'asc');
        }

        $query->where('department_id', $user['department_id']);

        // $query->leftJoin('job_orders', 'job_orders.id', '=', 'assignment.job_order_id')
        //     ->leftJoin('assignments', 'assignments.inventory_job_id', '=', 'inventory_jobs.id')
        //     ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'inventory_job_assigned_people.user_id')
        //     ->select(
        //         'inventory_jobs.*',
        //         'job_orders.project_name', 'job_orders.job_order_no',
        //         'inventory_job_assigned_people.user_id',
        //         'user_profiles.first_name', 'user_profiles.last_name',
        //         DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as assigned_person')
        //     );

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, InventoryJob::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;

        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $jos = JobOrderDepartmentInvolved::with('jobOrder')->where('department_id', $user['department_id'])
            ->whereNotIn(
                'job_order_id', 
                array_column(
                    Assignment::select('job_order_id')->where('department_id', $user['department_id'])->get()->toArray(), 
                    'job_order_id'
                )
            )
            ->get();

        $result = [];

        foreach ($jos as $jo) {
            $result[] = $jo->jobOrder;
        }

        return response()->json($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $input = $request->all();
        $input['deadline'] = date('Y-m-d H:i:s', strtotime($input['deadline']));
        $input['department_id'] = $user['department_id'];

        $jo = null;
        // Create the jo
        DB::transaction(function() use ($input, &$jo) {
            $inventory = Assignment::create($input);
            $jo = $inventory;
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
