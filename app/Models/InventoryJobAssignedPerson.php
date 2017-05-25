<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryJobAssignedPerson extends Model
{
    use SoftDeletes;

    protected $table = 'inventory_job_assigned_people';
    protected $fillable = ['inventory_job_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    function inventoryJob()
    {
        return $this->belongsTo('App\Models\inventoryJob');
    }
}
