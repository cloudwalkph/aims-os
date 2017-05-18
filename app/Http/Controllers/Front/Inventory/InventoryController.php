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
        $iJob = InventoryJob::with('jobOrder', 'assignedPerson')->find($joID);
        $header = view('inventory.print.header')->with('iJob', $iJob);

        $deliveryView = view('inventory.print.delivery')->with('iJob', $iJob);
        return view('inventory.print.index')
          ->with('iJob', $iJob)
          ->with('header', $header)
          ->with('content', $deliveryView);
    }

    function print_release($joID)
    {
        $iJob = InventoryJob::with('jobOrder', 'assignedPerson')->find($joID);
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

    function print_product_list()
    {
        $products = JobOrderProduct::with('jobOrder')->get();

        $productView = view('inventory.print.product')->with('products', $products);

        return view('inventory.print.index')->with('header', '')->with('content', $productView);
    }
}
