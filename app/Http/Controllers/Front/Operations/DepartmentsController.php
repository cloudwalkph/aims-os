<?php

namespace App\Http\Controllers\Front\Operations;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobOrder;
use App\Models\JobOrderAddUser;
use App\Models\JobOrderAnimationDetail;
use App\Models\JobOrderDepartmentInvolved;
use App\Models\JobOrderDetail;
use App\Models\JobOrderProduct;
use App\Models\JobOrderManpower;
use App\Models\JobOrderMeal;
use App\Models\JobOrderMom;
use App\Models\JobOrderProjectAttachment;
use App\Models\JobOrderVehicle;
use App\Models\ManpowerType;
use App\Models\MealType;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
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

    public function inventory()
    {
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.departments.inventory.index');
    }

    public function production()
    {
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.departments.production.index');
    }

    public function setup()
    {
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.departments.setup.index');
    }
}
