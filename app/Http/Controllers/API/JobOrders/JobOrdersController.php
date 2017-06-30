<?php
namespace App\Http\Controllers\API\JobOrders;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobOrders\AddAeRequest;
use App\Http\Requests\JobOrders\CreateJobOrderRequest;
use App\Models\Assignment;
use App\Models\JobOrder;
use App\Models\JobOrderAddUser;
use App\Models\JobOrderClient;
use App\Models\JobOrderDepartmentInvolved;
use App\Models\JobOrderDetail;
use App\Models\JobOrderManpower;
use App\Models\JobOrderMeal;
use App\Models\JobOrderMom;
use App\Models\JobOrderVehicle;
use App\Traits\FilterTrait;
use App\Traits\NotificationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobOrdersController extends Controller {
    use FilterTrait, NotificationTrait;

    public function all(Request $request)
    {
        $user = $request->user();

        if ($user->department->slug === "ae") {
            $jos = JobOrder::getUserCreatedJOs($user['id'])
                ->get();

            return response()->json($jos, 200);
        }

        $jos = JobOrder::all();

        return response()->json($jos, 200);
    }

    public function getByDepartmentInvolvement(Request $request)
    {
        $user = $request->user();
        $jos = JobOrderDepartmentInvolved::with('jobOrder')->where('department_id', $user['department_id'])
            ->get();

        $result = [];
        foreach ($jos as $jo) {
            $result[] = $jo->jobOrder;
        }

        return response()->json($result, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrder::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrder::orderBy('id', 'asc');
        }

        $query->join('job_order_clients', 'job_order_clients.job_order_id', '=', 'job_orders.id')
            ->join('clients', 'job_order_clients.client_id', '=', 'clients.id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'job_orders.user_id')
            ->leftJoin('job_order_animation_details', 'job_order_animation_details.job_order_id', '=', 'job_orders.id')
            ->groupBy('job_orders.id', 'user_profiles.last_name', 'user_profiles.first_name')
            ->select('job_orders.*', \DB::raw("GROUP_CONCAT(clients.`company` separator ', ') as company"),
                \DB::raw("SUM(job_order_animation_details.`target_selling` + job_order_animation_details.`target_flyering`
                + job_order_animation_details.`target_survey` + job_order_animation_details.`target_experiment`
                + job_order_animation_details.`target_others`+ job_order_animation_details.`target_sampling`) as total_traffic_count"),
                \DB::raw("GROUP_CONCAT(job_order_clients.`brands` separator ', ') as brands"),
                \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as created_by'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrder::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
\Log::info($query->toSql());
        // Get the data
        $jobOrders = $query->paginate($perPage);

        return response()->json($jobOrders, 200);
    }

    public function getByDepartmentId(Request $request, $departmentId)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrderDepartmentInvolved::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderDepartmentInvolved::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_department_involved.job_order_id')
            ->join('assignments', 'assignments.job_order_id', '=', 'job_orders.id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'assignments.user_id')
            ->groupBy('job_orders.id', 'user_profiles.last_name', 'user_profiles.first_name')
            ->select('job_orders.*', \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as created_by'))
            ->where('assignments.department_id', '=', $departmentId);

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrder::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $jobOrders = $query->paginate($perPage);

        return response()->json($jobOrders, 200);
    }

    /**
     * @param $clientId
     * @return mixed
     */
    public function show($clientId)
    {
        return JobOrder::find($clientId);
    }

    /**
     * @param CreateJobOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateJobOrderRequest $request)
    {
        $user = $request->user();
        $input = $request->all();

        $jo = null;
        // Create the client
        \DB::transaction(function() use ($user, $input, &$jo) {
            $input['user_id'] = $user->id;
            $input['project_types'] = json_encode([]);
            $input['job_order_no'] = strtoupper(uniqid());
            $clients = $input['clients'];
            unset($input['clients']);

            $jo = JobOrder::create($input);

            // Save ae to assignments table
            Assignment::create([
                'department_id'  => 8,
                'user_id'        => $input['user_id'],
                'job_order_id'   => $jo->id,
                'remarks'        => '',
                'deadline'       => Carbon::today()->addDays(10)->toDateString()
            ]);

            foreach ($clients as $client) {
                $clientData = [
                    'job_order_id'  => $jo->id,
                    'brands'        => json_encode($client['brands']),
                    'client_id'     => $client['id']
                ];

                JobOrderClient::create($clientData);
            }
        });

        return response()->json($jo, 201);
    }

    /**
     * @param CreateJobOrderRequest $request
     * @param $clientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateJobOrderRequest $request, $joId)
    {
        $input =$request->all();

        $jo = null;
        // Create the client
        \DB::transaction(function() use ($input, $joId, &$jo) {
            $jo = JobOrder::where('id', $joId)->update($input);
        });

        return response()->json($jo, 200);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $departments = JobOrderDepartmentInvolved::where('job_order_id', $joId)->delete();
        $manpowers = JobOrderManpower::where('job_order_id', $joId)->delete();
        $meals = JobOrderMeal::where('job_order_id', $joId)->delete();
        $vehicles = JobOrderVehicle::where('job_order_id', $joId)->delete();

        $jo = JobOrder::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }

    public function addAe(AddAeRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the client
        \DB::transaction(function() use ($input, &$jo) {
            $checkUser = JobOrderAddUser::where('job_order_id', $input['job_order_id'])
                ->where('user_id', $input['user_id'])
                ->first();

            // Check if user already in this jo
            if ($checkUser) {
                $jo = null;

                return;
//                throw new \Exception('AE already exists');
//                return response()->json(['error' => 'AE Already exists'], 400);
            }

            // Check if user is the owner of the jo
            $checkOwner = JobOrder::where('user_id', $input['user_id'])
                ->where('id', $input['job_order_id'])
                ->first();

            if ($checkOwner) {
                $jo = null;

                return;
            }

            $jo = JobOrderAddUser::create($input);
        });

        if ($jo) {
            $jo = JobOrderAddUser::with('user.profile')
                ->where('user_id', $jo->user_id)
                ->first();
        } else {
            return response()->json(['error' => 'AE Already exists'], 400);
        }

        $this->jobOrderUpdated($input['job_order_id'], $request->user());

        return response()->json($jo, 201);
    }

    public function saveJobOrderMOM(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;
        $mom = JobOrderMom::create($input);

        $this->jobOrderUpdated($joId, $request->user());

        return response()->json($mom, 200);
    }

    public function saveEventDetails(Request $request, $joId)
    {
        $input = $request->all();
        $input['job_order_id'] = $joId;

        if($input['event_specifications'] == "") {
            $input['event_specifications'] = " ";
        }

        $detail = JobOrderDetail::create($input);

        $this->jobOrderUpdated($joId, $request->user());

        return response()->json($detail, 200);
    }

    public function calendar()
    {
        $jos = JobOrder::with('joDetail')->get();

        $events = [];
        foreach ($jos as $jo) {
            $color = null;
            switch ($jo->status) {
                case 'pending':
                    $color = '#f0ad4e';
                    break;
                case 'cancelled':
                    $color = '#f05c4e';
                    break;
                case 'completed':
                    $color = '#51b00f';
                    break;
                default:
                    $color = '#f0ad4e';
            }

            if( isset($jo->joDetail->when) ) {
                $events[] = [
                    'id'    => $jo->id,
                    'title' => $jo->project_name. " - {$jo->status}",
                    'date' => $jo->joDetail->when,
                    'color' => $color
                ];
            }
        }

        return response()->json($events, 200);
    }
}
