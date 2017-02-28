<?php

namespace App\Http\Controllers\Front\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManpowerController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        config(['app.name' => 'Human Resources | AIMS']);

        return view('hr.Department.manpower');
    }
}
