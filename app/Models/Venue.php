<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use SoftDeletes;

    protected $table = 'venues';
    protected $guarded = ['id'];

    public function joVehicle()
    {
        return $this->hasMany('App\Models\JobOrderVehicle');
    }
}
