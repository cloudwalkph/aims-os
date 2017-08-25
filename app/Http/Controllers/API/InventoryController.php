<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Jobs\ImportInventory;

use App\Models\Inventory;
use App\Models\InventoryFiles;
use App\Models\JobOrder;
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

        $query->with('jobOrder');
        $query->with('inventoryFiles');

        // Filter
        if($request->has('category')) {
          $categories = $request->get('category');
          $query->whereIn('category', $categories);
        }
        if ($request->has('filter')) {
          $filterRequest = $request->get('filter');
          $query->whereHas('jobOrder', function($q) use($filterRequest) {
            $q->where('job_order_no', 'like', '%'.$filterRequest.'%');
            $q->orWhere('project_name', 'like', '%'.$filterRequest.'%');
          });
          $query->orWhere(function($q) use($filterRequest) {
            $q->orWhere('product_code', 'like', '%'.$filterRequest.'%');
            $q->orWhere('category', 'like', '%'.$filterRequest.'%');
            $q->orWhere('name', 'like', '%'.$filterRequest.'%');
            $q->orWhere('inventories.status', 'like', '%'.$filterRequest.'%');
          });
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
        $user = $request->user();
        $jo = null;
        // Create the jo inventory
        \DB::transaction(function() use ($request, &$jo) {
            $input = array(
              'category' => $request->input('category'),
              'product_code' => $request->input('product_code'),
              'name' => $request->input('product_name'),
              'quantity' => $request->input('quantity'),
              'expiration_date' => date('Y-m-d H:i:s', strtotime($request->input('expiration_date'))),
              'status' => $request->input('status'),
            );
            if($request->has('job_order_id') && $request->input('job_order_id') != 'null') {
              $input['job_order_id'] = $request->input('job_order_id');
            }
            $jo = Inventory::create($input);
        });
        // upload inventory pictures
        if($request->hasFile('pictures')) {
            $pictures = $request->file('pictures');
            foreach($pictures as $picture) {
              $extension = $picture->extension();
              $path = $picture->store('images');

              InventoryFiles::create(
                array(
                  'inventory_id' => $jo->id,
                  'url' => $path,
                  'file_type' => 'picture'
                )
              );
              $picture->move(public_path('images'), $path);
            }
        } else {
          $jo['warning'] = 'file not present';
        }

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
        $inventory = Inventory::with('inventoryFiles')->find($id);
        return $inventory;
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

    function import(Request $request)
    {
      if($request->hasFile('excel')) {
          $file = $request->file('excel');
          \Excel::load($file, function($reader) {
            $results = $reader->get();
            \DB::transaction(function() use ($results) {
              foreach ($results as $inventories) {
                foreach ($inventories as $inventory) {
                  $data = [
                    'category' => $inventory->category,
                    'product_code' => $inventory->sku,
                    'name' => $inventory->inventory_name,
                    'quantity' => $inventory->quantity,
                    'expiration_date' => date('Y-m-d', strtotime($inventory->expiration_date)),
                    'status' => $inventory->status,
                  ];

                  $query = JobOrder::where('job_order_no', $inventory->job_order_number);
                  if($query->count() > 0) {
                    $jo = $query->first();
                    $data['job_order_id'] = $jo->id;
                  }

                  if($data['product_code']) {
                    // dispatch queue
                    $this->dispatch(new ImportInventory($data));
                  }
                }
              }
            });
          });
      } else {
        $jo['warning'] = 'file not present';
      }
    }
}
