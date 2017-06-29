<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use SoftDeletes;

    protected $table = 'venues';
    protected $guarded = ['id'];

    public static $rules = [
        'category'       => 'required',
        'subcategory'    => 'required',
        'venue'          => 'required',
        'area'           => 'required',
        'sub_area'       => 'required',
        'street'         => 'required',
        'rate'           => 'required',
        'rate_max'       => 'required',
        'eft'            => 'required',
        'eft_male'       => 'required',
        'eft_female'     => 'required',
        'target_hits'    => 'required',
        'contact_person' => 'required',
        'contact_number' => 'required',
        'contact_email'  => 'required'
    ];

    public static $filterable = [
        'category',
        'venue',
        'area',
        'subcategory',
        'contact_person',
        'contact_email',
        'street'
    ];

    public function joVehicle()
    {
        return $this->hasMany('App\Models\JobOrderVehicle');
    }

    public function schedules()
    {
        return $this->hasMany(Venue::class);
    }
}
