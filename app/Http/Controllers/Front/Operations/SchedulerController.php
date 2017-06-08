<?php

namespace App\Http\Controllers\Front\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchedulerController extends Controller
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

    public function index()
    {
    	config(['app.name' => 'Operations | AIMS']);
    	return view('operations.schedules');
    }
}
