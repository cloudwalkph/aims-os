<?php

namespace App\Jobs;

use App\Models\Venue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportVenueFromExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $venue;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($venue)
    {
        $this->venue = $venue;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Venue::create($this->venue);
    }
}
