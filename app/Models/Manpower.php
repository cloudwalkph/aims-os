<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manpower extends Model
{
    use SoftDeletes;

    protected $table = 'manpowers';
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'manpower_type_id', 'agency_id',
        'birthdate', 'hired_date', 'city', 'email', 'contact_number', 'fb_link', 'violations','rate'];

    public static $filterable = [
        'first_name', 'last_name'
    ];

    public function files()
    {
        return $this->hasMany('App\Models\ManpowerFile');
    }

    public function manpowerType()
    {
        return $this->belongsTo('App\Models\ManpowerType');
    }

    public function agency()
    {
        return $this->belongsTo('App\Models\Agency');
    }

    public function joManpower()
    {
        return $this->hasMany('App\Models\JobOrderManpower');
    }

    public function ManpowerAssignType() 
    {
        return $this->hasMany('App\Models\ManpowerAssignTypes');
    }
}
