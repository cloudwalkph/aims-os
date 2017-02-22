<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';
    protected $guarded = ['id'];

    public static $rules = [
        'company'           => 'required|min:2',
        'contact_person'    => 'required|min:2',
        'contact_number'    => 'required|min:2',
        'email'             => 'required|email',
        'brands.*.name'     => 'required'
    ];

    public static $filterable = [
        'company',
        'contact_person',
        'contact_number',
        'birthdate',
        'email',
        'brands'
    ];

    public function jobOrderClients()
    {
        return $this->hasMany('App\Models\JobOrderClient');
    }

    /**
     * Serialization
     * ======================================================================================================
     */

    public function getCompanyAttribute()
    {
        return ucwords($this->attributes['company']);
    }
}
