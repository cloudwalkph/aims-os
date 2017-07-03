<?php

namespace App\Http\Controllers\Front\Operations;

use App\Http\Controllers\Controller;
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
use App\User;
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
        config(['app.name' => 'Operations | AIMS']);

        return view('operations.joborder.index');
    }

    public function show($joId)
    {
        config(['app.name' => 'Operations | AIMS']);

        $jo = JobOrder::where('job_order_no', '=', $joId)->first();

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

        $assigned = \DB::table('job_order_add_users')->join('users', 'users.id', '=', 'job_order_add_users.user_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'job_order_add_users.user_id')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->select('job_order_add_users.*', 'departments.name as department',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as user_name'))
            ->where('users.department_id', '=', '11')->where('job_order_id', '=', $jo->id)->get();

        $users = User::where('department_id', '=', 11)->get();

        return view('operations.joborder.details',
            compact('jo', 'users', 'assigned', 'brands', 'mom', 'detail',
                'animations', 'products', 'attachments', 'departments',
                'manpower_request', 'meal_request', 'vehicle_request'));
    }

    public function details($joId)
    {
        $jo = JobOrder::where('job_order_no', '=', $joId)->first();

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

        return view('operations.joborder.content.jodetails',
            compact('jo', 'brands', 'mom', 'detail',
                'animations', 'products', 'attachments', 'departments',
                'manpower_request', 'meal_request', 'vehicle_request'));
    }

    public function assignView($joId)
    {
        $jo = JobOrder::where('job_order_no', '=', $joId)->first();

        $users = User::where('department_id', '=', 11)->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            foreach ($client->brands as $b) {
                array_push($brands, ucwords($b->name));
            }
        }

        $assigned = \DB::table('job_order_add_users')->join('users', 'users.id', '=', 'job_order_add_users.user_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'job_order_add_users.user_id')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->select('job_order_add_users.*', 'departments.name as department',
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as user_name'))
            ->where('users.department_id', '=', '11')->where('job_order_id', '=', $jo->id)->get();

        return view('operations.joborder.content.assign', compact('jo', 'assigned', 'users', 'brands'));
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

        return view('operations.joborder.content.discussion', compact('jo', 'brands'));
    }

    public function assign(Request $request, $joId)
    {
        $input = $request->all();
        $jo = JobOrder::where('job_order_no', '=', $joId)->first();

        $data = [
            'job_order_id'  => $jo->id,
            'user_id'       => $input['user_id']
        ];

        $assigned = JobOrderAddUser::where('job_order_id', '=', $jo->id)
            ->where('user_id', '=', $data['user_id'])
            ->first();

        if($assigned) {
            return redirect()->back()->with('status', 'User already assigned to Job Order.');
        }
        $user = JobOrderAddUser::create($data);

        return redirect()->back();
    }
}
