<?php

namespace App;

use App\Models\Department;
use App\Models\Event;
use App\Models\JobOrder;
use App\Models\UserProfile;
use App\Models\UserRole;
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

    public static $rules = [
        'email'         => 'required',
        'first_name'    => 'required',
        'last_name'     => 'required',
        'user_role'     => 'required',
        'department'    => 'required',
        'street'        => 'required',
        'barangay'      => 'required',
        'city'          => 'required',
        'province'      => 'required',
        'date_hired'    => 'required',
    ];

    public static $filterable = [
        'department',
        'user_role',
        'first_name',
        'last_name',
        'email',
    ];

    /**
     * Associations
     * ======================================================================================================
     */

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class);
    }

    public function events()
    {
        return $this-$this->hasMany(Event::class);
    }
}
