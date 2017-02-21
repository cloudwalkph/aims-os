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

    public function jobOrderClients()
    {
        return $this->hasMany('App\Models\JobOrderClient');
    }
}
