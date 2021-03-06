<?php

namespace App\Http\Controllers\Front\AE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsExecutiveController extends Controller
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

        return view('ae.index');
    }

    public function schedules()
    {
        config(['app.name' => 'Accounts Executive Schedules | AIMS']);

        return view('ae.schedules');
    }

    public function references()
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.references');
    }
}
