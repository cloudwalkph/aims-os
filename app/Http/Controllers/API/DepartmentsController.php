<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;

class DepartmentsController extends Controller {
    public function index()
    {
        $departments = Department::all();

        return response()->json($departments, 200);
    }
}