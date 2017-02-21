<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    protected $table = 'user_profiles';
    protected $fillable = ['user_id', 'first_name', 'middle_name', 'last_name',
        'birthdate', 'street', 'barangay', 'city', 'province', 'status',
        'date_hired', 'last_login', 'profile_picture'];

    /**
     * Association
     * ======================================================================================================
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Serialization
     * ======================================================================================================
     */

    public function getFullNameAttribute()
    {
        return ucwords($this->attributes['first_name'] . ' ' . $this->attributes['last_name']);
    }
}
