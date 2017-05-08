<?php

namespace App\Http\Controllers\Front\AE;

use App\Http\Controllers\Controller;
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
use Illuminate\Http\Request;

class JobOrderController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.jolist.index');
    }

    public function create()
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        return view('ae.jolist.create.create');
    }

    public function show($joNumber)
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();
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


        return view('ae.jolist.details.index')
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

    public function preview($joNumber)
    {
        config(['app.name' => 'Accounts Executive | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('id', $joNumber)->first();

        $mom = JobOrderMom::where('status', 'active')
            ->where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $detail = JobOrderDetail::where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $animations = JobOrderAnimationDetail::where('job_order_id', $jo->id)
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

//        print_r($jo->user->profile); exit;
        return view('ae.jolist.details.print.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('detail', $detail)
            ->with('mom', $mom)
            ->with('attachments', $attachments)
            ->with('departments', $departments)
            ->with('animations', $animations);
    }

    public function previewManpower($joNumber)
    {

        $jo = JobOrder::with('clients', 'user')->where('id', $joNumber)->first();
        
        $manpower_request = JobOrderManpower::where('job_order_id', $jo->id)
            ->with('manpowerType')->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
        }

        return view('ae.jolist.details.print.manpower')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('manpowers', $manpower_request);
    }

    public function previewMeal($joNumber)
    {

        $jo = JobOrder::with('clients', 'user')->where('id', $joNumber)->first();

        $meal_request = JobOrderMeal::where('job_order_id', $jo->id)
            ->with('mealType')->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
        }

        return view('ae.jolist.details.print.meal')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('meals', $meal_request);
    }

    public function previewVehicle($joNumber)
    {

        $jo = JobOrder::with('clients', 'user')->where('id', $joNumber)->first();

        $vehicle_request = JobOrderVehicle::where('job_order_id', $jo->id)
            ->with('vehicleType')->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
        }

        return view('ae.jolist.details.print.vehicle')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('vehicles', $vehicle_request);
    }
}
