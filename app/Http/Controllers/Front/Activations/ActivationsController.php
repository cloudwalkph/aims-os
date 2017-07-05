<?php

namespace App\Http\Controllers\Front\Activations;

use App\Http\Controllers\Controller;
use App\Models\JobOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivationsController extends Controller
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
    public function index(Request $request)
    {
        config(['app.name' => 'Project Manager | AIMS']);

        $jo = JobOrder::all();

        $totalCount = count($jo);

        return view('activations.index', compact('totalCount'));
    }
}
