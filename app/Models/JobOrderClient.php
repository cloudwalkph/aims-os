<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrderClient extends Model
{
    use SoftDeletes;

    protected $table = 'job_order_clients';
    protected $guarded = ['id'];

    public function jobOrders()
    {
        return $this->belongsToMany('App\Models\JobOrder');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    /**
     * Serialization
     * ======================================================================================================
     */

    public function getBrandsAttribute()
    {
        return json_decode($this->attributes['brands']);
    }
}
