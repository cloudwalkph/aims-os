<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryJob extends Model
{
    use SoftDeletes;

    protected $table = 'inventory_jobs';
    protected $fillable = ['job_order_no', 'description', 'deadline'];

    public function jobOrders()
    {
        return $this->belongsTo('App\Models\JobOrder');
    }

    public function assignedPerson()
    {
        return $this->hasMany('App\Models\InventoryJobAssignedPerson');
    }
}
