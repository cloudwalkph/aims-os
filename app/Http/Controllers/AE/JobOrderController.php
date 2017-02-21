<?php

namespace App\Http\Controllers\AE;

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

        $jos = JobOrder::all();

        return view('ae.jolist.index', compact('jos'));
    }
}
