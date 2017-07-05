<?php
namespace App\Http\Controllers\API\JobOrders;

use App\Events\NewDiscussion;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobOrders\CreateDiscussionRequest;
use App\Models\JobOrderDiscussion;
use App\Traits\NotificationTrait;

class JobOrderDiscussionsController extends Controller {
    use NotificationTrait;

    public function getDiscussions($jobOrderId)
    {
        $discussions = JobOrderDiscussion::with('user.profile')->where('job_order_id', $jobOrderId)
            ->get();

        return response()->json($discussions, 200);
    }

    public function createDiscussion(CreateDiscussionRequest $request, $jobOrderId)
    {
        $user = $request->user();
        $input = $request->only(['user_id', 'message']);
        $input['user_id'] = $user->id;
        $input['job_order_id'] = $jobOrderId;

        $discussion = JobOrderDiscussion::create($input);

        if (! $discussion) {
            return response()->json(['creating a discussion failed'], 400);
        }

        $discussion = JobOrderDiscussion::with('user.profile', 'jobOrder')
            ->where('id', $discussion->id)
            ->first();

        // Notification
        $this->newDiscussionMessage($jobOrderId, $user);

        // Event
        event(new NewDiscussion($discussion));

        return response()->json($discussion, 201);
    }
}