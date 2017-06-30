<?php

namespace App\Http\Controllers\Front\AE;

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
use App\Models\JobOrderSchedule;
use App\Models\JobOrderVehicle;
use App\Models\ManpowerType;
use App\Models\MealType;
use App\Models\VehicleType;
use App\Models\Venue;
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
        config(['app.name' => 'Minutes of the Meeting | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();
        $mom = JobOrderMom::where('status', 'active')
            ->where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

//        $attachments = JobOrderProjectAttachment::where('job_order_id', $jo->id)
//            ->get();

//        $departments = JobOrderDepartmentInvolved::where('job_order_id', $jo->id)
//            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $aes = JobOrderAddUser::where('job_order_id', $jo->id)->get();

//        $mealTypes = MealType::all();
//
//        $manpowerTypes = ManpowerType::all();
//
//        $vehicleTypes = VehicleType::all();
//
//        $manpower_request = JobOrderManpower::where('job_order_id', $jo->id)
//            ->with('manpowerType')->get();
//
//        $vehicle_request = JobOrderVehicle::where('job_order_id', $jo->id)
//            ->with('vehicleType')->get();
//
//        $meal_request = JobOrderMeal::where('job_order_id', $jo->id)
//            ->with('mealType')->get();

        return view('ae.jolist.details.mom.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('mom', $mom)
            ->with('aes', $aes);
//            ->with('attachments', $attachments)
//            ->with('mealTypes', $mealTypes)
//            ->with('manpowerTypes', $manpowerTypes)
//            ->with('vehicleTypes', $vehicleTypes)
//            ->with('manpower_request', $manpower_request)
//            ->with('vehicle_request', $vehicle_request)
//            ->with('meal_request', $meal_request)
//            ->with('departments', $departments);
    }

    public function eventDetails($joNumber)
    {
        config(['app.name' => 'Event Details | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $detail = JobOrderDetail::where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $animations = JobOrderAnimationDetail::where('job_order_id', $jo->id)
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

        $venues = Venue::all();

        $schedules = JobOrderSchedule::where('job_order_id', $jo->id)
            ->get();

        return view('ae.jolist.details.event.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('aes', $aes)
            ->with('detail', $detail)
            ->with('animations', $animations)
            ->with('venues', $venues)
            ->with('schedules', $schedules)
            ->with('departments', $departments);
    }

    public function createJOSchedule(Request $request, $joNumber)
    {
        $input = $request->all();
        $jo = JobOrder::where('job_order_no', $joNumber)->first();
        $input['job_order_id'] = $jo->id;

        $schedule = JobOrderSchedule::create($input);

        if ($schedule) {
            $request->session()->flash('success', 'Successfully added a new schedule for this job order');
        } else {
            $request->session()->flash('error', 'Failed in creating a new schedule for this job order');
        }

        return redirect()->back();
    }

    public function projectAttachments($joNumber)
    {
        config(['app.name' => 'Project Attachments | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $attachments = JobOrderProjectAttachment::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $aes = JobOrderAddUser::where('job_order_id', $jo->id)->get();

        return view('ae.jolist.details.project.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('aes', $aes)
            ->with('attachments', $attachments);
    }

    public function projectStatus($joNumber)
    {
        config(['app.name' => 'Project Attachments | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $attachments = JobOrderProjectAttachment::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $aes = JobOrderAddUser::where('job_order_id', $jo->id)->get();

        return view('ae.jolist.details.status.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('aes', $aes)
            ->with('attachments', $attachments);
    }

    public function requestForms($joNumber)
    {
        config(['app.name' => 'Project Attachments | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $mealTypes = MealType::all();

        $manpowerTypes = ManpowerType::all();

        $vehicleTypes = VehicleType::all();

        $manpowerRequest = JobOrderManpower::where('job_order_id', $jo->id)
            ->with('manpowerType')->get();

        $vehicleRequest = JobOrderVehicle::where('job_order_id', $jo->id)
            ->with('vehicleType')->get();

        $mealRequest = JobOrderMeal::where('job_order_id', $jo->id)
            ->with('mealType')->get();

        $aes = JobOrderAddUser::where('job_order_id', $jo->id)->get();

        return view('ae.jolist.details.requests.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('aes', $aes)
            ->with('mealTypes', $mealTypes)
            ->with('manpowerTypes', $manpowerTypes)
            ->with('vehicleTypes', $vehicleTypes)
            ->with('manpower_request', $manpowerRequest)
            ->with('vehicle_request', $vehicleRequest)
            ->with('meal_request', $mealRequest);
    }

    public function discussions($joNumber)
    {
        config(['app.name' => 'Project Attachments | AIMS']);

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $aes = JobOrderAddUser::where('job_order_id', $jo->id)->get();

        return view('ae.jolist.details.discussion.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('aes', $aes);
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

//        print_r($jo->user->profile); exit;
        return view('ae.jolist.details.print.index')
            ->with('jo', $jo)
            ->with('brands', $brands)
            ->with('detail', $detail)
            ->with('mom', $mom)
            ->with('attachments', $attachments)
            ->with('departments', $departments)
            ->with('products', $products)
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
