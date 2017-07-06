<?php

namespace App\Events;

use App\Models\JobOrderDiscussion;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewDiscussion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $discussion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($discussion)
    {
        $this->discussion = $discussion;
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('jo.'.$this->discussion->job_order_id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $user = $this->discussion->user;
        $profile = $this->discussion->user->profile;

        $array = $this->discussion->toArray();

        $array['user'] = $user->toArray();
        $array['user']['profile'] = $profile->toArray();

//        \Log::info($array);

        return $array;
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
//    public function broadcastAs()
//    {
//        return 'new.message';
//    }
}
