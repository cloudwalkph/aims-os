<?php

namespace App\Http\Controllers\Front\AE;

use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use Illuminate\Http\Request;

class JobOrderController extends Controller
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
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.jolist.index');
    }

    public function create()
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.jolist.create.create');
    }

    public function show($joNumber)
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
        }

        return view('ae.jolist.details.index')
            ->with('jo', $jo)
            ->with('brands', $brands);
    }
}
