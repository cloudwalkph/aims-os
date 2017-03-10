<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManpowerSchedules extends Model
{
    use SoftDeletes;

    protected $table = 'manpower_schedules';
    protected $fillable = ['job_order_id', 'venue_id', 'type', 'created_datetime', 'batch'];

    public function venue()
    {
    	return $this->belongsTo('App\Models\Venue');
    }

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }
}
