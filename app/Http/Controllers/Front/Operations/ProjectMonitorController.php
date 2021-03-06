<?php

namespace App\Http\Controllers\Front\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectMonitorController extends Controller
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
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.project-monitor.index');
    }
}
