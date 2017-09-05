<?php

namespace App\Http\Controllers\Front\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobOrder;
use App\Models\InventoryJob;
use App\Models\JobOrderProduct;

class InventoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        config(['app.name' => 'Inventory | AIMS']);

        return view('inventory.index');
    }

    function print_delivery($joID)
    {
        $iJob = InventoryJob::with(
          'jobOrder.user.profile',
          'jobOrder.products.deliveries',
          'assignedPerson.user.profile'
        )->find($joID);
        $header = view('inventory.print.header')->with('iJob', $iJob);

        $deliveryView = view('inventory.print.delivery')->with('iJob', $iJob);
        return view('inventory.print.index')
          ->with('iJob', $iJob)
          ->with('header', $header)
          ->with('content', $deliveryView);
    }

    function print_release($joID)
    {
        $iJob = InventoryJob::with(
          'jobOrder.user.profile',
          'jobOrder.products.releases',
          'assignedPerson.user.profile'
        )->find($joID);
        $header = view('inventory.print.header')->with('iJob', $iJob);

        $releaseView = view('inventory.print.release')->with('iJob', $iJob);
        return view('inventory.print.index')
          ->with('iJob', $iJob)
          ->with('header', $header)
          ->with('content', $releaseView);
    }

    function print_work_details($joID)
    {
        $jo = JobOrder::where('id', $joID)->first();

        return view('inventory.print')->with('jo', $jo);
    }

    function print_product_list($id = null)
    {
        $query = JobOrderProduct::select('job_order_products.*')->with('jobOrder.products');

        if($id) {
          $query->where('job_order_id', $id);
        }

        $query->has('jobOrder');

        $query->leftJoin(\DB::raw('(SELECT product_id, SUM(delivery_quantity) AS delivered FROM inventory_deliveries GROUP BY product_id) AS inventory_deliveries'), function($q) {
          $q->on('job_order_products.id', '=', 'inventory_deliveries.product_id');
        });
        $query->addSelect('delivered');

        $query->leftJoin(\DB::raw('(SELECT product_id, SUM(dispose_quantity) AS disposed, SUM(return_quantity) AS returned FROM inventory_releases GROUP BY product_id) AS inventory_releases'), function($q) {
          $q->on('job_order_products.id', '=', 'inventory_releases.product_id');
        });
        $query->addSelect('disposed', 'returned');
        $query->addSelect(\DB::raw('(IFNULL(delivered, 0) - IFNULL(disposed, 0) + IFNULL(returned, 0)) as products_on_hand, (IFNULL(disposed, 0) - IFNULL(returned, 0)) as total_disposed'));

        $result = $query->get();

        $productView = view('inventory.print.product')->with('products', $result);

        return view('inventory.print.index')->with('header', '')->with('content', $productView);
    }
}
