<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use SoftDeletes;

    protected $table = 'job_orders';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\JobOrderClient');
    }

    public function moms()
    {
        return $this->hasMany('App\Models\JobOrderMom');
    }

    public function joManpower()
    {
        return $this->hasMany('App\Models\JobOrderManpower');
    }

    public function creativesJob()
    {
        return $this->hasMany('App\Models\CreativesJob', 'id', 'job_order_no');
    }
}
