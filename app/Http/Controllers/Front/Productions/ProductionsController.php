<?php

namespace App\Http\Controllers\Front\Productions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOrder;
use App\Models\Productions;
use App\Models\ProductionsItems;

class ProductionsController extends Controller
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
        config(['app.name' => 'Productions | AIMS']);

        return view('productions.index');
    }

    public function jos()
    {
        config(['app.name' => 'Productions | AIMS']);

        return view('productions.jo');
    }

    public function show($joNo)
    {
        config(['app.name' => 'Productions | AIMS']);


        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNo)->first();
        $productionDatas  = Productions::join('production_items', 'productions.id', '=', 'production_items.production_id')
            ->where('productions.id', $jo->id)
            ->orderBy('production_items.id', 'desc')
            ->get();

        return view('productions.jolist.details.index')
            ->with('jo', $jo)
            ->with('productionDatas', $productionDatas);
    }

    public function references(){
        config(['app.name' => 'Productions | AIMS']);

        return view('productions.references');
    }

    public function costing($joNo){
        config(['app.name' => 'Productions | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNo)->first();

        return view('productions.jolist.details.costing')
        ->with('jo', $jo);
    }
}
