<?php
namespace App\Traits;

use App\Http\Requests\Events\CreateEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

trait EventsTrait {
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $events = Event::getDepartmentEvents($user->department->id)
            ->get();

        return $events;
    }

    /**
     * @param CreateEventRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEventRequest $request)
    {
        // Get user input
        $input = $request->all();

        // Create event
        $event = Event::create($input);

        return response()->json($event);
    }

    /**
     * @param UpdateEventRequest $request
     * @param $eventId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateEventRequest $request, $eventId)
    {
        // Get authenticated user
        $user = $request->user();

        // Get user input
        $input = $request->all();

        // Find the event to update and check if this user owns it on their department
        $event = Event::where('id', $eventId)
            ->getDepartmentEvents($user->department_id)
            ->first();

        // Check if the event exists
        if (! $event) {
            return response()->json(['error' => 'Invalid event'], 400);
        }

        // Update the event
        Event::where('id', $eventId)->update($input);

        return response()->json(['message' => 'Successfully updated event'], 200);
    }
}