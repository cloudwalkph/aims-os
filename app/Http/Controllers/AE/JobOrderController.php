<?php

namespace App\Http\Controllers\AE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobOrderController extends Controller
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

        $jos = [
            [
                'job_order_no' => '58905fa4bec2e',
                'project_name' => 'Project Doe',
                'project_type' =>
                    [
                        'name' => 'Logistics',
                    ],
                'client_name' => 'John Doe',
                'brand' =>
                    [
                        'name' => 'Cream Silk'
                    ],
                'status' => "pending"
            ]
        ];

        return view('ae.jolist.index', compact('jos'));
    }
}
