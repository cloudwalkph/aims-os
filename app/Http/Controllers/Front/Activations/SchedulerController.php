<?php

namespace App\Http\Controllers\Front\Activations;

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
    	config(['app.name' => 'Project Manager | AIMS']);
    	return view('activations.schedules');
    }
}
