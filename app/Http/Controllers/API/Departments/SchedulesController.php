<?php
namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Traits\EventsTrait;
use Illuminate\Http\Request;

class SchedulesController extends Controller {
    use EventsTrait;

    public function index(Request $request)
    {
        // Sort
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->get('sort'));
            $query = Event::orderBy($sortCol, $sortDir);
        } else {
            $query = Event::orderBy('id', 'asc');
        }

        $query->join('departments', 'departments.id', '=', 'events.department_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'events.user_id')
            ->groupBy('events.id', 'user_profiles.last_name', 'user_profiles.first_name')
            ->select('events.*', 'departments.name as department', \DB::raw('CONCAT(user_profiles.first_name, " ", user_profiles.last_name) as user_name'));

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, Event::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
        \Log::info($query->toSql());
        // Get the data
        $jobOrders = $query->paginate($perPage);

        return response()->json($jobOrders, 200);
    }
}