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
use App\Models\JobOrderProduct;
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

        $products = JobOrderProduct::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $attachments = JobOrderProjectAttachment::where('job_order_id', $jo->id)
            ->get();

        $departments = JobOrderDepartmentInvolved::where('job_order_id', $jo->id)
            ->get();

        $manpower_request = JobOrderManpower::where('job_order_id', $jo->id)
            ->with('manpowerType')->get();

        $meal_request = JobOrderMeal::where('job_order_id', $jo->id)
            ->with('mealType')->get();

        $vehicle_request = JobOrderVehicle::where('job_order_id', $jo->id)
            ->with('vehicleType')->get();

        return view('components.jo.content.jodetails', compact('jo', 'brands', 'mom', 'detail',
            'animations', 'products', 'attachments', 'departments',
            'manpower_request', 'meal_request', 'vehicle_request'));
    }

    public function discussions($joId)
    {
        config(['app.name' => 'Operations | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joId)->first();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        return view('components.jo.content.discussion', compact('jo', 'brands'));
    }
}