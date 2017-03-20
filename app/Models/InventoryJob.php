<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryJob extends Model
{
    use SoftDeletes;

    protected $table = 'inventory_jobs';
    protected $fillable = ['job_order_id', 'description', 'deadline'];

    public static $rules = [
        'job_order_id'     => 'required',
        'description'      => 'required',
        'deadline'         => 'required',
    ];

    public function jobOrders()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function assignedPerson()
    {
        return $this->hasMany('App\Models\InventoryJobAssignedPerson');
    }
}
