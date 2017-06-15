<?php
namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobOrder;
use App\Models\JobOrderAddUser;
use App\Models\JobOrderAnimationDetail;
use App\Models\JobOrderDepartmentInvolved;
use App\Models\JobOrderDetail;
use App\Models\JobOrderManpower;
use App\Models\JobOrderMeal;
use App\Models\JobOrderMom;
use App\Models\JobOrderProjectAttachment;
use App\Models\JobOrderVehicle;
use App\Models\ManpowerType;
use App\Models\MealType;
use App\Models\VehicleType;

class JobOrdersController extends Controller {
    public function index($joNo) {
        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNo)->first();
        $mom = JobOrderMom::where('status', 'active')
            ->where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $detail = JobOrderDetail::where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $animations = JobOrderAnimationDetail::where('job_order_id', $jo->id)
            ->get();

        $attachments = JobOrderProjectAttachment::where('job_order_id', $jo->id)
            ->get();

        $departments = JobOrderDepartmentInvolved::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $aes = JobOrderAddUser::where('job_order_id', $jo->id)->get();

        $mealTypes = MealType::all();

        $manpowerTypes = ManpowerType::all();

        $vehicleTypes = VehicleType::all();

        $manpower_request = JobOrderManpower::where('job_order_id', $jo->id)
            ->with('manpowerType')->get();

        $vehicle_request = JobOrderVehicle::where('job_order_id', $jo->id)
            ->with('vehicleType')->get();

        $meal_request = JobOrderMeal::where('job_order_id', $jo->id)
            ->with('mealType')->get();

        $departmentLists = Department::all();

        return view('job-orders.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('mom', $mom)
            ->with('aes', $aes)
            ->with('detail', $detail)
            ->with('departmentLists', $departmentLists)
            ->with('animations', $animations)
            ->with('attachments', $attachments)
            ->with('mealTypes', $mealTypes)
            ->with('manpowerTypes', $manpowerTypes)
            ->with('vehicleTypes', $vehicleTypes)
            ->with('manpower_request', $manpower_request)
            ->with('vehicle_request', $vehicle_request)
            ->with('meal_request', $meal_request)
            ->with('departments', $departments);
    }
}