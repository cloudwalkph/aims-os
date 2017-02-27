<?php

namespace App\Http\Controllers\Front\Accounting;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Accounting;

class AccountingController extends Controller
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
        config(['app.name' => 'Accounting | AIMS']);

        $tasks = DB::table('job_orders')->get();

//        return $tasks;

        return view('accounting.index', compact('tasks'));
    }
}
