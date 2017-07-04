<?php

namespace App\Http\Controllers\Front\Activations;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        config(['app.name' => 'Project Manager | AIMS']);

        return view('activations.index');
    }
}
