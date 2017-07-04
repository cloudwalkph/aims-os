<?php

namespace App\Http\Controllers\Front\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOrder;

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

    public function getJoList() {
        config(['app.name' => 'Setup | AIMS']);

        return view('setup.Pooling.index');
    }

    public function viewJo($joId) {
        config(['app.name' => 'Setup | AIMS']);
        $jo = JobOrder::where('id',$joId)->first();
        
        return view('setup.Pooling.joDetailView')
                ->with('jo', $jo);
    }

    public function finalJo($joId) {
        config(['app.name' => 'Setup | AIMS']);
        $jo = JobOrder::where('id',$joId)->first();
        
        return view('setup.Final.index')
                ->with('jo', $jo);
    }
}
