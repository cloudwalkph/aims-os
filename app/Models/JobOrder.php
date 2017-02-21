<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrder extends Model
{
    use SoftDeletes;

    protected $table = 'job_orders';
    protected $guarded = ['id'];

    public static $rules = [
        'project_name'           => 'required|min:2',
        'project_types.*.name'   => 'required',
        'clients.*.id'           => 'required'
    ];

    public static $filterable = [
        'job_order_no',
        'project_name',
        'created_by',
        'brands',
        'company',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clients()
    {
        return $this->hasMany(JobOrderClient::class);
    }

    public function moms()
    {
        return $this->hasMany(JobOrderMom::class);
    }

    public function joManpower()
    {
        return $this->hasMany(JobOrderManpower::class);
    }

    public function creativesJob()
    {
        return $this->hasMany(CreativesJob::class, 'id', 'job_order_no');
    }
}
