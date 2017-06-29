<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderSchedules extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_schedules';
    protected $fillable = ['job_order_id', 'remarks', 'venue_id', 'jo_datetime', 'status'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
