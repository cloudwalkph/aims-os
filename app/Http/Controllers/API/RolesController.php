<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserRole;

class RolesController extends Controller {
    public function index()
    {
        $roles = UserRole::all();

        return response()->json($roles, 200);
    }
}