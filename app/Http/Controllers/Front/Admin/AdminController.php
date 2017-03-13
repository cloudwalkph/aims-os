<?php

namespace App\Http\Controllers\Front\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        config(['app.name' => 'Admin Dashboard | AIMS']);

        return view('admin.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        config(['app.name' => 'Admin Dashboard | AIMS']);

        return view('admin.users');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function agencies()
    {
        config(['app.name' => 'Admin Dashboard | AIMS']);

        return view('admin.agencies');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manpowerTypes()
    {
        config(['app.name' => 'Admin Dashboard | AIMS']);

        return view('admin.manpowerType');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vehicleTypes()
    {
        config(['app.name' => 'Admin Dashboard | AIMS']);

        return view('admin.vehicleType');
    }
}
