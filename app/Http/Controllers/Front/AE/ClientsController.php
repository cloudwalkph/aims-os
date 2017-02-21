<?php

namespace App\Http\Controllers\Front\AE;

use App\Http\Controllers\Controller;
use App\Models\Client;
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
        $clients = Client::all();

        return view('ae.clients.index', compact('clients'));
    }
}
