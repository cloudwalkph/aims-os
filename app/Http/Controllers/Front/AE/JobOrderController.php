<?php

namespace App\Http\Controllers\Front\AE;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobOrder;
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
            array_push($brands, ucwords($client->brands[0]->name));
        }

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

        $jo = JobOrder::with('clients', 'user')->where('job_order_no', $joNumber)->first();

        $detail = JobOrderDetail::where('job_order_id', $jo->id)
            ->orderBy('id', 'desc')->first();

        $animations = JobOrderAnimationDetail::where('job_order_id', $jo->id)
            ->get();

        $brands = [];
        foreach ($jo->clients as $client) {
            array_push($brands, ucwords($client->brands[0]->name));
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
            ->with('attachments', $attachments)
            ->with('departments', $departments)
            ->with('animations', $animations);
    }

    public function saveJobOrderMOM(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;
        $mom = JobOrderMom::create($input);

        return redirect()->back();
    }

    public function saveEventDetails(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;
        $detail = JobOrderDetail::create($input);

        return redirect()->back();
    }

    public function saveAnimationDetails(Request $request, $joId)
    {
        $detail = null;
        \DB::transaction(function() use ($request, &$detail, $joId) {
            // Get all the input
            $input = $request->all();
            $input['job_order_id'] = $joId;

            // Create new jo animation details
            $detail = JobOrderAnimationDetail::create($input);
        });

        return redirect()->back();
    }

    public function uploadProjectAttachments(Request $request, $joId)
    {
        if (! $request->hasFile('file')) {
            return redirect()->back();
        }

        $jo = JobOrder::where('id', $joId)->first();

        $file = $request->file('file');
        $filename = $jo->job_order_no.'-'.$file->getFilename().'.'.$file->extension();

        // Move to storage
        $path = $file->storeAs('project-attachments', $filename);

        // Attachment data
        $data = [
            'job_order_id'      => $joId,
            'file_name'         => $filename,
            'reference_for'     => $request->get('reference_for')
        ];

        JobOrderProjectAttachment::create($data);

        return redirect()->back();
    }

    public function downloadAttachment($attachmentId)
    {
        $attachment = JobOrderProjectAttachment::where('id', $attachmentId)->first();

        $filename = 'app/project-attachments/'.$attachment->file_name;

        $file = storage_path($filename);

        return response()->download($file, $attachment->file_name);
    }

    public function saveDepartmentInvolve(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;

        $department = JobOrderDepartmentInvolved::create($input);

        return redirect()->back();
    }

    public function saveManpower(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;

        // Create new jo manpower request
        $manpower = JobOrderManpower::create($input);

        return redirect()->back();
    }

    public function saveMeal(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;

        // Create new jo meal request
        $meal = JobOrderMeal::create($input);

        return redirect()->back();
    }

    public function saveVehicle(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;

        // Create new jo vehicle request
        $vehicle = JobOrderVehicle::create($input);

        return redirect()->back();
    }
}
