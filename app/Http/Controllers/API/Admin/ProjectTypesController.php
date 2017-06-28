<?php
namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectType;

class ProjectTypesController extends Controller {
    public function index()
    {
        $projectTypes = ProjectType::all();

        return response()->json($projectTypes, 200);
    }
}