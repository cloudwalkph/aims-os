<?php

namespace App\Http\Controllers\Front\Productions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductionsController extends Controller
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
        config(['app.name' => 'Productions | AIMS']);

        return view('productions.index');
    }
}
