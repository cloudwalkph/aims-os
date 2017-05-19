<?php
namespace App\Traits;

use App\Models\Event;

trait SimpleEventTrait {
    public function createEvent($data)
    {
        $data['meta'] = json_encode($data['meta']);

        Event::create($data);
    }
}