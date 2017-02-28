<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MealType;

class MealTypesController extends Controller {
    public function index()
    {
        $types = MealType::all();

        return response()->json($types, 200);
    }
}