<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Inventory;
use App\Models\JobOrderDepartmentInvolved;

use App\Models\JobOrderProduct;

use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // user
        $user = $request->user();

        $query = JobOrderProduct::select('job_order_products.*');

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query->orderBy($sortCol, $sortDir);
        } else {
            $query->orderBy('job_order_products.id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_products.job_order_id')
            ->addSelect('job_orders.project_name', 'job_orders.job_order_no');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, $query->$filterable);
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
        //
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
