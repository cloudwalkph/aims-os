<?php

namespace App\Http\Controllers\AE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientsController extends Controller
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
        $clients = [
            [
                'company_name' => 'Unilever',
                'contact_person' => 'John Doe',
                'contact_number' => '09121231234',
                'email' => 'johndoe@unilever.com',
                'brand' =>
                    [
                        'name' => 'Cream silk'
                    ],
                    [
                        'name' => 'Sun silk'
                    ],
            ]
        ];
        return view('ae.clients.index', compact('clients'));
    }
}
