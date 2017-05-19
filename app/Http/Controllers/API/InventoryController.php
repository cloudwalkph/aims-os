<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Inventory;
use App\Models\JobOrderDepartmentInvolved;

use App\Traits\FilterTrait;

use DB;

class InventoryController extends Controller
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

        $query = Inventory::select('inventories.*');

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query->orderBy($sortCol, $sortDir);
        } else {
            $query->orderBy('inventories.id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'inventories.job_order_id')
            ->addSelect('job_orders.project_name', 'job_orders.job_order_no');

        // Filter
        if ($request->has('filter')) {
          $filterables = [
            'job_order_no',
            'category',
            'product_code',
            'name',
            'inventories.status'
          ];
            $this->filter($query, $request, $filterables);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;

        // Get the data
        // $query->where('user_profiles.user_id', $user['id']);
        $jos = $query->paginate($perPage);

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
    public function store(Request $request)
    {
        $jo = null;
        // Create the jo inventory
        \DB::transaction(function() use ($request, &$jo) {
            $input = array(
              'job_order_id' => $request->input('job_order_id'),
              'category' => $request->input('category'),
              'product_code' => $request->input('product_code'),
              'name' => $request->input('product_name'),
              'quantity' => $request->input('quantity'),
              'expiration_date' => date('Y-m-d H:i:s', strtotime($request->input('expiration_date'))),
              'status' => $request->input('status'),
            );
            $jo = Inventory::create($input);
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
        //
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
    public function update(Request $request, $id)
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
        //
    }

    public function getByDepartmentInvolvement(Request $request)
    {
        $user = $request->user();
        $jos = JobOrderDepartmentInvolved::with('jobOrder.user.profile')
            ->where('department_id', $user['department_id'])
            ->get();

        $result = [];
        if($jos->count() > 0) {
            $result = $jos->toArray();
        }

        return response()->json($result, 200);
    }
}
