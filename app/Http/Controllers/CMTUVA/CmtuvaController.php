<?php

namespace App\Http\Controllers\CMTUVA;

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
}
