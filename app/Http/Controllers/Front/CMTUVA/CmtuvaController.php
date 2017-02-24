<?php

namespace App\Http\Controllers\Front\CMTUVA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmtuvaController extends Controller
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
        config(['app.name' => 'CMTUVA | AIMS']);

        return view('cmtuva.index');
    }

    public function schedules()
    {
        config(['app.name' => 'CMTUVA SCHEDULES | AIMS']);

        return view('cmtuva.schedules');
    }

    public function venues()
    {
        config(['app.name' => 'CMTUVA VENUES | AIMS']);

        return view('cmtuva.index');
    }

    public function plans()
    {
        config(['app.name' => 'CMTUVA PLANS | AIMS']);

        return view('cmtuva.index');
    }
}
