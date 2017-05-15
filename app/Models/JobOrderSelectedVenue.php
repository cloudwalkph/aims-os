<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderSelectedVenue extends Model
{
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class, 'job_order_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
}
