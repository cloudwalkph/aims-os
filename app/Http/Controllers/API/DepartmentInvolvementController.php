<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentInvolved\CreateDepartmentInvolvedRequest;
use App\Models\Event;
use App\Models\JobOrder;
use App\Models\JobOrderDepartmentInvolved;
use App\Notifications\NewJobOrderAssignment;
use App\Traits\FilterTrait;
use App\Traits\NotificationTrait;
use App\Traits\SimpleEventTrait;
use App\User;
use Illuminate\Http\Request;

class DepartmentInvolvementController extends Controller {
    use FilterTrait, SimpleEventTrait, NotificationTrait;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $joId)
    {
        // user
        $user = $request->user();

        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = JobOrderDepartmentInvolved::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderDepartmentInvolved::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_department_involved.job_order_id')
            ->join('departments', 'departments.id', '=', 'job_order_department_involved.department_id')
            ->where('job_order_department_involved.job_order_id', '=', $joId)
            ->select('job_order_department_involved.*', 'job_orders.project_name',
                'job_orders.job_order_no', 'departments.name');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderDepartmentInvolved::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $departments = $query->paginate($perPage);

        return response()->json($departments, 200);
    }

    public function store(CreateDepartmentInvolvedRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo department involvement
        \DB::transaction(function() use ($input, $request, &$jo) {
            $filename = '';
            if ($request->hasFile('department_file')) {
                $filename = uniqid() . '.'. $request->file('department_file')->extension();
                $request->file('department_file')->storeAs('jo', $filename);
            }

            $input['file'] = $filename;

            unset($input['department_file']);

            $jo = JobOrderDepartmentInvolved::create($input);

            $jo = JobOrderDepartmentInvolved::where('id', $jo->id)
                ->with('department', 'jobOrder')->first();

            // Create schedule
            $event = [
                'meta'  => [
                    'job_order_id'  => $jo->job_order_id,
                    'deliverables'  => $jo->deliverables,
                    'file'          => $jo->file
                ],
                'event_datetime'    => $jo->deadline,
                'department_id'     => $jo->department_id,
                'user_id'           => 0,
                'title'             => $jo->jobOrder->job_order_no . ': ' . $jo->jobOrder->project_name,
                'type'              => 'jo',
                'scope'             => 'public'
            ];

            $this->createEvent($event);

            // Notify the department head
            $this->newAssignedJobOrder($jo->job_order_id, $jo->department_id);
        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $jo = JobOrderDepartmentInvolved::where('id', $id)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}