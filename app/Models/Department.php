<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';
    protected $fillable = ['name', 'slug'];

    /**
     * Associations
     * ======================================================================================================
     */

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function joVehicle()
    {
        return $this->hasMany('App\Models\JobOrderVehicle');
    }

    public function joDepartment()
    {
        return $this->hasMany(JobOrderDepartmentInvolved::class);
    }

    public function events()
    {
        return $this-$this->hasMany(Event::class);
    }
}
