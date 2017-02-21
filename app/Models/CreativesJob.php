<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreativesJob extends Model
{
    use SoftDeletes;

    protected $table = 'creatives_jobs';
    protected $fillable = ['job_order_no', 'description', 'deadline'];

    public function jobOrders()
    {
        return $this->belongsTo('App\Models\JobOrder', 'job_order_no', 'id');
    }

    public function assignedPerson()
    {
        return $this->hasOne('App\Models\CreativesJobAssignedPerson');
    }
}
