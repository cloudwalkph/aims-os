<?php

namespace App\Http\Controllers\Creatives;

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
        return view('creatives.index');
    }
}
