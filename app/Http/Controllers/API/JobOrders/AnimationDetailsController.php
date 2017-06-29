<?php
namespace App\Http\Controllers\API\JobOrders;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimationDetails\CreateAnimationDetailsRequest;
use App\Models\JobOrderAnimationDetail;
use App\Traits\FilterTrait;
use Illuminate\Http\Request;

class AnimationDetailsController extends Controller {
    use FilterTrait;
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
            $query = JobOrderAnimationDetail::orderBy($sortCol, $sortDir);
        } else {
            $query = JobOrderAnimationDetail::orderBy('id', 'asc');
        }

        $query->join('job_orders', 'job_orders.id', '=', 'job_order_animation_details.job_order_id')
            ->where('job_order_animation_details.job_order_id', '=', $joId)
            ->select('job_order_animation_details.*');

        // Filter
        if ($request->has('filter')) {
            $this->filter($query, $request, JobOrderAnimationDetail::$filterable);
        }

        // Count per page
        $perPage = $request->has('per_page') ? (int) $request->get('per_page') : null;
//        \Log::info($query->toSql());
        // Get the data
        $jos = $query->paginate($perPage);

        return response()->json($jos, 200);
    }

    /**
     * @param CreateAnimationDetailsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAnimationDetailsRequest $request)
    {
        $input = $request->all();

        $jo = null;
        // Create the jo
        \DB::transaction(function() use ($input, &$jo) {
            $jo = JobOrderAnimationDetail::create($input);

            $jo = JobOrderAnimationDetail::where('id', $jo->id)->first();

        });

        return response()->json($jo, 201);
    }

    /**
     * @param $joId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($joId)
    {
        $jo = JobOrderAnimationDetail::where('id', $joId)->delete();

        if (! $jo) {
            return response()->json([], 400);
        }

        return response()->json($jo, 200);
    }
}