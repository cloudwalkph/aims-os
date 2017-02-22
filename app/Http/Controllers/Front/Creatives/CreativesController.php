<?php

namespace App\Http\Controllers\Front\Creatives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreativesController extends Controller
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
        config(['app.name' => 'Creatives | AIMS']);

        return view('creatives.index');
    }

    public function schedules()
    {
        config(['app.name' => 'Creatives Schedules | AIMS']);

        return view('creatives.schedules');
    }
}
