<?php

namespace App\Listeners;

use App\Events\NewDiscussion;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastDiscussionMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewDiscussion  $event
     * @return void
     */
    public function handle(NewDiscussion $event)
    {
        //
    }
}
