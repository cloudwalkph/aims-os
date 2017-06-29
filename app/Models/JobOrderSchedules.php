<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOrderSchedules extends Model
{
    protected $table = 'job_order_schedules';
    protected $fillable = ['job_order_id', 'description', 'venue_id', 'jo_datetime', 'status'];

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }
}
