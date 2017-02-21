<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'user_role_id', 'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\UserRole', 'user_role_id');
    }

    public function jobOrders()
    {
        return $this->hasMany('App\Models\JobOrder');
    }

    public function assignedPerson()
    {
        return $this->hasMany('App\Models\CreativesJobAssignedPerson');
    }
}
