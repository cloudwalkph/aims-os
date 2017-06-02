<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobOrders\CreateJobOrderProductRequest;
use App\Models\JobOrderProduct;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class JobOrderProductController extends Controller {
    use FilterTrait;
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $joId)
    {
        // user
        $user = $request->user();

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrderProduct::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderProduct::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_products.job_order_id')
            ->where('job_order_products.job_order_id', '=', $joId)
            ->select('job_order_products.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderProduct::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $departments = $query->paginate($perPage);

        return response()->json($departments, 200);
    }

    public function store(CreateJobOrderProductRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo inventory
        \DB::transaction(function() use ($input, &$jo) {

            $jo = JobOrderProduct::create($input);

            $jo = JobOrderProduct::where('id', $jo->id)
                ->with('jobOrder')->first();
        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $jo = JobOrderProduct::where('id', $id)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }

    function all(Request $request)
    {
        $query = JobOrderProduct::select('job_order_products.*');

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query->orderBy($sortCol, $sortDir);
        } else {
            $query->orderBy('job_order_products.id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_products.job_order_id');
        $query->addSelect('job_orders.project_name', 'job_orders.job_order_no');

        $query->leftJoin(\DB::raw('(SELECT product_id, SUM(delivery_quantity) AS delivered FROM inventory_deliveries WHERE deleted_at IS NULL GROUP BY product_id) AS inventory_deliveries'), function($q) {
          $q->on('job_order_products.id', '=', 'inventory_deliveries.product_id');
        });
        $query->addSelect('delivered');
        $query->leftJoin(\DB::raw('(SELECT product_id, SUM(dispose_quantity) AS disposed, SUM(return_quantity) AS returned FROM inventory_releases where deleted_at IS NULL GROUP BY product_id) AS inventory_releases'), function($q) {
          $q->on('job_order_products.id', '=', 'inventory_releases.product_id');
        });
        $query->addSelect('disposed', 'returned');
        $query->addSelect(\DB::raw('(IFNULL(delivered, 0) - IFNULL(disposed, 0) + IFNULL(returned, 0)) as products_on_hand, (IFNULL(disposed, 0) - IFNULL(returned, 0)) as total_disposed'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, array('project_name', 'job_order_no', 'item_name'));
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;

        // Get the data
        $result = $query->paginate($perPage);

        return response()->json($result, 200);
    }
}
