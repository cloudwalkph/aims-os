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
use App\User;
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

    public function show($departmentId)
    {
        $department = Department::where('id', $departmentId)->first();
        config(['app.name' => 'Operations | AIMS']);

        if($departmentId == 11) {
            $assigned = \DB::table('job_order_add_users')->join('users', 'users.id', '=', 'job_order_add_users.user_id')
                ->join('user_profiles', 'user_profiles.user_id', '=', 'job_order_add_users.user_id')
                ->join('departments', 'departments.id', '=', 'users.department_id')
                ->select('job_order_add_users.*', 'departments.name as department',
                    \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as user_name'))
                ->where('users.department_id', '=', '11')->get();

            $users = User::where('department_id', '=', 11)->get();

            return view('operations.departments.'.$department->slug.'.index', compact('assigned', 'users'));
        }

        return view('operations.departments.'.$department->slug.'.index');
    }

    public function showDetails($departmentId, $joNo)
    {
        $department = Department::where('id', $departmentId)->first();
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.departments.'.$department->slug.'.show');
    }

}
