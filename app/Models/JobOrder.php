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
        'clients'                => 'required',
        'clients.*.id'           => 'required',
        'clients.*.brands'       => 'required'
    ];

    public static $filterable = [
        'created_by',
        'brands',
        'company',
        'status',
        'job_order_no',
        'project_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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

    public function joProjects()
    {
        return $this->hasMany(JobOrderProjectAttachment::class);
    }

    public function products()
    {
        return $this->hasMany(JobOrderProduct::class);
    }

    public function discussions()
    {
        return $this->hasMany(JobOrderDiscussion::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function selectedVenues()
    {
        return $this->hasMany(JobOrderSelectedVenue::class);
    }

    function inventoryJobs()
    {
        return $this->hasMany(InventoryJob::class);
    }

    /**
     * Local Scopes
     * ======================================================================================================
     */

    /**
     * @param $query
     * @param $departmentId
     * @return mixed
     */
    public function scopeGetUserCreatedJOs($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Serialization
     * ======================================================================================================
     */

    public function getBrandsAttribute()
    {
        $brands = explode(', ', $this->attributes['brands']);

        return $brands;
    }

    public function getProjectNameAttribute()
    {
        $brands = ucwords($this->attributes['project_name']);

        return $brands;
    }
}
