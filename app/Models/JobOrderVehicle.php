<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderVehicle extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_vehicles';
    protected $guarded = ['id'];

    public function jobOrder()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function vehicleType()
    {
        return $this->belongsTo('App\Models\VehicleType');
    }

    public function venue()
    {
        return $this->belongsTo('App\Models\Venue');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
