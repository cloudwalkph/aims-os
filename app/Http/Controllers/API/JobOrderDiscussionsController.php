<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobOrders\CreateDiscussionRequest;
use App\Models\JobOrderDiscussion;

class JobOrderDiscussionsController extends Controller {
    public function getDiscussions($jobOrderId)
    {
        $discussions = JobOrderDiscussion::where('job_order_id', $jobOrderId)
            ->get();

        return response()->json($discussions, 200);
    }

    public function createDiscussion(CreateDiscussionRequest $request, $jobOrderId)
    {
        $user = $request->user();
        $input = $request->all();
        $input['user_id'] = $user->id;
        $input['job_order_id'] = $jobOrderId;

        $discussion = JobOrderDiscussion::create($input);

        if (! $discussion) {
            return response()->json(['creating a discussion failed'], 400);
        }

        return response()->json($discussion, 201);
    }
}