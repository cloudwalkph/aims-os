<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;

class VehicleTypesController extends Controller {
    public function index()
    {
        $types = VehicleType::all();

        return response()->json($types, 200);
    }
}