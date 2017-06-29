<?php

namespace App\Http\Controllers\Front\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetupController extends Controller
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
        config(['app.name' => 'Setup | AIMS']);

        return view('setup.index');
    }

    public function manpowerList() {
        config(['app.name' => 'Setup | AIMS']);

        return view('setup.Manpower.index');
    }
}
