<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientsController extends Controller {

    public function index()
    {
        $clients = Client::paginate();

        return response()->json($clients, 200);
    }
}