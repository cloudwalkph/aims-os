<?php

namespace App\Http\Controllers\Front\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobOrder;

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
        $jo = JobOrder::where('id', $joID)->first();
        
        $deliveryView = view('inventory.print.delivery')->with('jo', $jo);
        return view('inventory.print.index')->with('content', $deliveryView);
    }

    function print_release($joID)
    {
        $jo = JobOrder::where('id', $joID)->first();
        
        $releaseView = view('inventory.print.release')->with('jo', $jo);
        return view('inventory.print.index')->with('content', $releaseView);
    }

    function print_work_details($joID)
    {
        $jo = JobOrder::where('id', $joID)->first();

        return view('inventory.print')->with('jo', $jo);
    }
}
