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
            $query = InventoryJob::orderBy($sortCol, $sortDir);
        } else {
            $query = InventoryJob::orderBy('id', 'asc');
        }

        $query->with('jobOrder', 'assignedPerson');

        // Filter
        if ($request->has('filter')) {
          $filterables = [
            'job_order_no',
            'project_name',
            'description',
          ];
            $this->filter($query, $request, $filterables);
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
                    InventoryJob::select('job_order_id')->get()->toArray(),
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
      $jo = '';
      $input = $request->all();
      $user = $request->user();
      DB::transaction(function() use($input, $user) {
        $job_order = json_decode($input['job_order']);
        $job_users = json_decode($input['users']);

        /* Create Inventory Job */
        $inventory_jobs_data = [
          'job_order_id' => $job_order->value,
          'description' => $input['description'],
          'deadline' => date('Y-m-d H:i:s', strtotime($input['deadline'])),
        ];
        $created_inventory_job = InventoryJob::create($inventory_jobs_data);

        /* Create Inventory Job Assigned People */
        if(count($job_users) > 0) {
          foreach($job_users as $job_user) {
            $users_data = [
              'inventory_job_id' => $created_inventory_job->id,
              'user_id' => $job_user->value
            ];
            InventoryJobAssignedPerson::create($users_data);
          }
        }

        foreach($job_users as $job_user) {
          $assignment_data['job_order_id'] = $job_order->value;
          $assignment_data['user_id'] = $job_user->value;
          $assignment_data['department_id'] = $user['department_id'];
          $assignment_data['remarks'] = $input['description'];
          $assignment_data['deadline'] = date('Y-m-d', strtotime($input['deadline']));

          /* create the inventory job */
          $created_inventory_job = Assignment::create($assignment_data);
        }
      });

      $jo = [
        'message' => 'Inventory Job Created'
      ];

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
        return InventoryJob::with('jobOrder', 'assignedPerson')->find($id);
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
