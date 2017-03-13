<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use SoftDeletes;

    protected $table = 'vehicle_types';
    protected $fillable = ['name', 'slug'];

    public static $rules = [
        'name' => 'required',
    ];

    public static $filterable = [
        'name',
        'slug'
    ];

    public function joVehicle()
    {
        return $this->hasMany('App\Models\JobOrderVehicle');
    }
}
